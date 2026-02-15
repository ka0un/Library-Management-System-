# Vercel Deployment Setup

This project is configured to automatically deploy to Vercel when changes are merged to the `main` branch.

## GitHub Actions Workflow

The CI/CD pipeline (`.github/workflows/ci.yml`) includes:

1. **Test Phase (Placeholder)**: 
   - Currently a placeholder for Playwright JS tests
   - When ready to implement tests, uncomment the commented steps in the workflow file
   - Install Playwright with: `npm install -D @playwright/test`
   - Add test scripts to `package.json`

2. **Deploy Phase**:
   - Automatically deploys to Vercel after tests pass
   - Only runs on `main` branch

## Required GitHub Secrets

To enable automatic deployment, add the following secrets to your GitHub repository:

1. **VERCEL_TOKEN**: Your Vercel authentication token
   - Get it from: https://vercel.com/account/tokens

2. **VERCEL_ORG_ID**: Your Vercel organization ID
   - Find it in your Vercel project settings

3. **VERCEL_PROJECT_ID**: Your Vercel project ID
   - Find it in your Vercel project settings

### How to Add Secrets:
1. Go to your GitHub repository
2. Navigate to Settings > Secrets and variables > Actions
3. Click "New repository secret"
4. Add each of the three secrets above

## Vercel Configuration

The `vercel.json` file configures the PHP runtime for Vercel deployment.

## Testing Locally

When Playwright tests are added:
```bash
# Install dependencies
npm install

# Install Playwright browsers
npx playwright install --with-deps

# Run tests
npm test
```

## Notes

- The test phase is currently a placeholder and will pass automatically
- Playwright tests should be added in the future
- The deployment will only occur after the test phase completes successfully
