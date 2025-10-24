from flask import Flask, request, jsonify
from pytubefix import YouTube
import re
import os

app = Flask(__name__)

def is_valid_youtube_url(url):
    """Validate YouTube URL"""
    youtube_regex = (
        r'(https?://)?(www\.)?'
        r'(youtube|youtu|youtube-nocookie)\.(com|be)/'
        r'(watch\?v=|embed/|v/|.+\?v=)?([^&=%\?]{11})')
    
    youtube_regex_match = re.match(youtube_regex, url)
    return youtube_regex_match is not None

@app.route('/')
def home():
    return jsonify({
        'status': 'online',
        'message': 'YouTube Downloader API',
        'endpoints': {
            'video_info': '/video_info (POST)',
            'download': '/download/<resolution> (POST)'
        }
    })

@app.route('/video_info', methods=['POST'])
def video_info():
    """Get video information"""
    try:
        data = request.get_json()
        url = data.get('url')
        
        if not url:
            return jsonify({'error': 'URL is required'}), 400
        
        if not is_valid_youtube_url(url):
            return jsonify({'error': 'Invalid YouTube URL'}), 400
        
        yt = YouTube(url)
        
        return jsonify({
            'title': yt.title,
            'author': yt.author,
            'length': yt.length,
            'views': yt.views,
            'description': yt.description,
            'publish_date': str(yt.publish_date),
            'thumbnail_url': yt.thumbnail_url
        })
    
    except Exception as e:
        return jsonify({'error': str(e)}), 500

@app.route('/download/<resolution>', methods=['POST'])
def download_video(resolution):
    """Get download URL for specified resolution"""
    try:
        data = request.get_json()
        url = data.get('url')
        
        if not url:
            return jsonify({'error': 'URL is required'}), 400
        
        if not is_valid_youtube_url(url):
            return jsonify({'error': 'Invalid YouTube URL'}), 400
        
        yt = YouTube(url)
        
        # Get streams
        streams = yt.streams.filter(progressive=True, file_extension='mp4')
        
        # Try to get the requested resolution
        video_stream = streams.filter(resolution=resolution).first()
        
        # If not available, get the highest quality
        if not video_stream:
            video_stream = streams.get_highest_resolution()
        
        if not video_stream:
            return jsonify({'error': 'No suitable stream found'}), 404
        
        return jsonify({
            'download_url': video_stream.url,
            'resolution': video_stream.resolution,
            'filesize': video_stream.filesize,
            'title': yt.title
        })
    
    except Exception as e:
        return jsonify({'error': str(e)}), 500

if __name__ == '__main__':
    port = int(os.environ.get('PORT', 10000))
    app.run(host='0.0.0.0', port=port, debug=False)

