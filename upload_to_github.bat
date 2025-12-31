@echo off
echo ========================================
echo  Inflation Calculator - GitHub Upload
echo ========================================
echo.

REM Check if git is installed
git --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ERROR: Git is not installed!
    echo.
    echo Please install Git from: https://git-scm.com/download/win
    echo Then run this script again.
    pause
    exit /b 1
)

echo Git is installed. Proceeding...
echo.

REM Navigate to project directory
cd /d "%~dp0"

echo Current directory: %CD%
echo.

REM Initialize git repository (if not already initialized)
if not exist .git (
    echo Initializing git repository...
    git init
    echo.
)

REM Add all files
echo Adding files to git...
git add .
echo.

REM Create commit
echo Creating commit...
git commit -m "Initial commit: Inflation Calculator with dark mode design"
echo.

echo ========================================
echo  Setup Complete!
echo ========================================
echo.
echo Next steps:
echo 1. Create a new repository on GitHub: https://github.com/new
echo 2. Copy the repository URL (e.g., https://github.com/contactmatthew/inflation-calculator.git)
echo 3. Run these commands:
echo.
echo    git remote add origin YOUR_REPO_URL
echo    git branch -M main
echo    git push -u origin main
echo.
echo OR use GitHub Desktop for easier upload!
echo.
pause

