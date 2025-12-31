# How to Upload to GitHub

Follow these steps to upload your Inflation Calculator to GitHub:

## Step 1: Install Git (if not already installed)

1. Download Git from: https://git-scm.com/download/win
2. Install it with default settings
3. Restart your terminal/PowerShell after installation

## Step 2: Configure Git (first time only)

Open PowerShell or Command Prompt and run:
```bash
git config --global user.name "Your Name"
git config --global user.email "your.email@example.com"
```

## Step 3: Navigate to Your Project

Open PowerShell/Command Prompt and run:
```bash
cd "C:\xampp\htdocs\Inflation calculator"
```

## Step 4: Initialize Git Repository

```bash
git init
```

## Step 5: Add All Files

```bash
git add .
```

## Step 6: Create Initial Commit

```bash
git commit -m "Initial commit: Inflation Calculator with dark mode design"
```

## Step 7: Create Repository on GitHub

1. Go to https://github.com/new
2. Repository name: `inflation-calculator` (or any name you prefer)
3. Description: "Professional inflation calculator with multi-country support and real-time exchange rates"
4. Choose: **Public** or **Private**
5. **DO NOT** initialize with README, .gitignore, or license (we already have these)
6. Click **"Create repository"**

## Step 8: Connect to GitHub and Push

After creating the repository, GitHub will show you commands. Use these:

```bash
git remote add origin https://github.com/contactmatthew/inflation-calculator.git
git branch -M main
git push -u origin main
```

**Note:** Replace `contactmatthew/inflation-calculator` with your actual GitHub username and repository name.

## Step 9: Enter GitHub Credentials

When prompted:
- **Username**: Your GitHub username (contactmatthew)
- **Password**: Use a **Personal Access Token** (not your regular password)

### How to Create Personal Access Token:

1. Go to GitHub → Settings → Developer settings → Personal access tokens → Tokens (classic)
2. Click "Generate new token (classic)"
3. Give it a name like "Inflation Calculator Upload"
4. Select scopes: Check **"repo"** (this gives full control of private repositories)
5. Click "Generate token"
6. **Copy the token immediately** (you won't see it again)
7. Use this token as your password when pushing

## Alternative: Use GitHub Desktop (Easier)

If you prefer a graphical interface:

1. Download GitHub Desktop: https://desktop.github.com/
2. Install and sign in with your GitHub account
3. Click "File" → "Add Local Repository"
4. Browse to: `C:\xampp\htdocs\Inflation calculator`
5. Click "Publish repository" button
6. Choose repository name and visibility
7. Click "Publish repository"

## Files Included

The repository includes:
- ✅ All PHP files (API endpoints, config, setup)
- ✅ HTML/CSS/JavaScript (index.php)
- ✅ Database schema (database.sql)
- ✅ Documentation (README.md, INSTALLATION.md)
- ✅ .gitignore file (excludes unnecessary files)

## What's Excluded (.gitignore)

- Database files (actual data, not schema)
- Log files
- Temporary files
- IDE settings

## After Uploading

Once uploaded, you can:
- Share the repository link
- Clone it on other machines
- Collaborate with others
- Deploy to web hosting services

## Repository URL Format

Your repository will be accessible at:
```
https://github.com/contactmatthew/inflation-calculator
```

Make sure to update the repository name if you used a different one!

