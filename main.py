from flask import Flask, request, jsonify
import yt_dlp
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
        
        ydl_opts = {
            'quiet': True,
            'no_warnings': True,
            'extract_flat': False,
        }
        
        with yt_dlp.YoutubeDL(ydl_opts) as ydl:
            info = ydl.extract_info(url, download=False)
            
            return jsonify({
                'title': info.get('title', 'Unknown'),
                'author': info.get('uploader', 'Unknown'),
                'length': info.get('duration', 0),
                'views': info.get('view_count', 0),
                'description': info.get('description', ''),
                'publish_date': info.get('upload_date', ''),
                'thumbnail_url': info.get('thumbnail', '')
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
        
        # Map resolution to format
        height_map = {
            '360p': 360,
            '480p': 480,
            '720p': 720,
            '1080p': 1080,
        }
        
        target_height = height_map.get(resolution, 720)
        
        ydl_opts = {
            'quiet': True,
            'no_warnings': True,
            'format': f'bestvideo[height<={target_height}][ext=mp4]+bestaudio[ext=m4a]/best[height<={target_height}][ext=mp4]/best',
            'merge_output_format': 'mp4',
            'geo_bypass': True,
            'nocheckcertificate': True,
        }
        
        with yt_dlp.YoutubeDL(ydl_opts) as ydl:
            info = ydl.extract_info(url, download=False)
            
            # Get the download URL
            if 'url' in info:
                download_url = info['url']
            elif 'requested_formats' in info:
                # Merged format
                download_url = info['requested_formats'][0]['url']
            elif 'formats' in info:
                # Get best format
                formats = [f for f in info['formats'] if f.get('height') and f['height'] <= target_height]
                if formats:
                    best_format = max(formats, key=lambda f: f.get('height', 0))
                    download_url = best_format['url']
                else:
                    return jsonify({'error': 'No suitable format found'}), 404
            else:
                return jsonify({'error': 'Could not get download URL'}), 404
            
            return jsonify({
                'download_url': download_url,
                'resolution': f"{info.get('height', 0)}p",
                'filesize': info.get('filesize', 0),
                'title': info.get('title', 'Unknown')
            })
    
    except Exception as e:
        return jsonify({'error': str(e)}), 500

if __name__ == '__main__':
    port = int(os.environ.get('PORT', 10000))
    app.run(host='0.0.0.0', port=port, debug=False)
