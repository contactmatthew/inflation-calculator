@echo off
echo ========================================
echo  Uploading to GitHub
echo ========================================
echo.

cd /d "%~dp0"

echo Initializing git repository...
git init
echo.

echo Adding all files...
git add .
echo.

echo Creating commit...
git commit -m "Initial commit: Inflation Calculator with dark mode design"
echo.

echo Setting branch to main...
git branch -M main
echo.

echo Adding remote origin...
git remote add origin https://github.com/contactmatthew/inflation-calculator.git
echo.

echo Pushing to GitHub...
echo Note: You may be prompted for GitHub username and password/token
echo.
git push -u origin main

echo.
echo ========================================
if %errorlevel% == 0 (
    echo SUCCESS! Your project has been uploaded to GitHub!
    echo.
    echo Repository URL: https://github.com/contactmatthew/inflation-calculator
) else (
    echo ERROR: Push failed. Please check the error above.
    echo.
    echo If you get authentication errors:
    echo 1. Use your GitHub username: contactmatthew
    echo 2. Use a Personal Access Token (not your password)
    echo    Create one at: https://github.com/settings/tokens
)
echo ========================================
pause

