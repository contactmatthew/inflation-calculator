# Quick Upload to GitHub - Easiest Method

## Option 1: GitHub Desktop (RECOMMENDED - Easiest)

1. **Download GitHub Desktop**:
   - Go to: https://desktop.github.com/
   - Download and install GitHub Desktop
   - Sign in with your GitHub account (contactmatthew)

2. **Upload Your Project**:
   - Open GitHub Desktop
   - Click **"File"** → **"Add Local Repository"**
   - Click **"Choose..."** and navigate to: `C:\xampp\htdocs\Inflation calculator`
   - Click **"Add Repository"**
   - You'll see all your files listed
   - At the bottom, write a commit message: "Initial commit: Inflation Calculator"
   - Click **"Commit to main"**
   - Click **"Publish repository"** button (top right)
   - Repository name: `inflation-calculator` (or any name you want)
   - Choose **Public** or **Private**
   - Click **"Publish Repository"**
   - Done! Your project is now on GitHub

## Option 2: Using Git Command Line

If you prefer command line, first install Git:

1. **Install Git**:
   - Download from: https://git-scm.com/download/win
   - Install with default settings
   - Restart your terminal after installation

2. **Open PowerShell** in your project folder and run:

```bash
cd "C:\xampp\htdocs\Inflation calculator"
git init
git add .
git commit -m "Initial commit: Inflation Calculator"
git branch -M main
git remote add origin https://github.com/contactmatthew/inflation-calculator.git
git push -u origin main
```

**Note**: When prompted for credentials:
- Username: `contactmatthew`
- Password: Use a **Personal Access Token** (not your regular password)

### How to Create Personal Access Token:
1. Go to GitHub → Settings → Developer settings → Personal access tokens → Tokens (classic)
2. Click "Generate new token (classic)"
3. Name it: "Inflation Calculator Upload"
4. Check "repo" scope
5. Click "Generate token"
6. Copy the token and use it as your password

---

**Your repository will be available at:**
https://github.com/contactmatthew/inflation-calculator

(Replace `inflation-calculator` with whatever name you choose)

