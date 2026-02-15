
# Libruary Management System

Live Prototype : [https://prototype.hapangama.com](https://prototype.hapangama.com)

> this project was abandoned and no longer will be maintained!

## Managing a Library Management System: Breaking Down Complexity

> A library management system is complex, so we simplify it by breaking it into smaller parts called subsystems (Decoupling) . This makes it easier to build. We've divided our system into four main components.

 - Frontend (User Interface)

 - High-Level Functions (Backend)

 - Validator Functions (Backend)

 - SQL Wrappers (Backend)

Each of these parts can be constructed independently, yet they synergize to achieve our ultimate objective: a fully functional library management system. As the group leader, I've further subdivided these four subsystems into 40 tasks, assigning each task to individual group members for efficient development and collaboration.

![Whiteboard 5](https://github.com/ka0un/webapp/assets/88395585/85f21c86-03ec-453e-a74f-c11537b361ef)


# Tools & Services

> Softwires and Services that we are using to build prototype of our IWT 2nd Assignment

### Developement Environment
- IDE [PhpStorm](https://www.jetbrains.com/phpstorm/)
- Code Editor [Vs Code](https://code.visualstudio.com/)
- Server [XAMPP](https://www.apachefriends.org/download.html)

### Server
- Software [NGINX](https://www.nginx.com/resources/glossary/nginx/)
- VPS [Oracle Cloud VMS](https://www.oracle.com/cloud/compute/virtual-machines/)
- Database [MariaDB](https://mariadb.org/about/)
- Mail [SMTP](https://www.geeksforgeeks.org/simple-mail-transfer-protocol-smtp/) 
- Dns [Cloudflare DNS](https://www.cloudflare.com/application-services/products/dns/)

### 3rd Party Apis
- Profile Picture [ui-avatars](https://ui-avatars.com/)
- Book Cover [placehold](https://placehold.co/)

### Other
- Version Control [GIT](https://git-scm.com/downloads)
- Repo Hosting [Github](https://github.com/)
- Project Management [Trello](https://trello.com/)
- SFTP Client [FileZilla](https://filezilla-project.org/)
- Remote DB Client [Dbeaver](https://dbeaver.io/)
- Graphs and Diagrams [draw.io](https://draw.io/)

### Indirect (not directly associated with this project)
- Remote SSH Client [PUTTY](https://putty.org/)
- SSL Certificate [Certbot](https://certbot.eff.org/)
- Domain Retail [namechap.com](https://www.namecheap.com/)
- Containerization [Docker](https://www.docker.com/)
- Hosting-Web-Panel [Petrodactyl](https://pterodactyl.io/)

# CI/CD and Deployment

## Automated Testing and Deployment to Vercel

This project is configured to automatically deploy to Vercel when code is merged to the `main` branch. Tests are run before deployment to ensure code quality.

### Workflow Overview

1. **Tests Run First**: When code is pushed to `main`, PHPUnit tests are automatically executed
2. **Deployment on Success**: If all tests pass, the application is automatically deployed to Vercel
3. **Deployment Blocked on Failure**: If any tests fail, deployment is prevented

### Setup Instructions

To enable automatic deployment, you need to configure the following GitHub Secrets:

1. **VERCEL_TOKEN**: Your Vercel authentication token
   - Go to [Vercel Account Tokens](https://vercel.com/account/tokens)
   - Create a new token
   - Add it as a GitHub secret named `VERCEL_TOKEN`

2. **VERCEL_ORG_ID**: Your Vercel organization ID
   - Run `vercel link` in your project directory
   - Find the `orgId` in `.vercel/project.json`
   - Add it as a GitHub secret named `VERCEL_ORG_ID`

3. **VERCEL_PROJECT_ID**: Your Vercel project ID
   - Run `vercel link` in your project directory
   - Find the `projectId` in `.vercel/project.json`
   - Add it as a GitHub secret named `VERCEL_PROJECT_ID`

### Running Tests Locally

```bash
# Install dependencies
composer install

# Run tests
composer test
```

### Manual Deployment to Vercel

```bash
# Install Vercel CLI
npm i -g vercel

# Deploy to production
vercel --prod
```

### Testing Infrastructure

- **Framework**: PHPUnit 9.6
- **Test Location**: `tests/` directory
- **Configuration**: `phpunit.xml`
- **Test Suite**: Basic tests to validate PHP environment and file structure
