web: gunicorn main:app --bind 0.0.0.0:$PORT --timeout 120
```

5. **Commit**

6. **Wait for Railway to redeploy**

---

## 🔍 **OR - Check Railway Settings:**

### **In Railway Dashboard:**

1. Click **"Settings"** tab
2. Scroll to **"Deploy"** section
3. Look for **"Start Command"**
4. It should show: `gunicorn main:app --bind 0.0.0.0:${PORT:-8000}`

**If empty or wrong, set it to:**
```
gunicorn main:app --bind 0.0.0.0:$PORT
