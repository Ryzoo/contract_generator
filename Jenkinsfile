pipeline {
  agent any
  stages {
    stage('Install') {
      parallel {
        stage('Composer') {
          steps {
            sh 'composer update && composer install'
          }
        }

        stage('Copy .env') {
          steps {
            sh 'mv .env.testing .env'
          }
        }

      }
    }

    stage('Build') {
      parallel {
        stage('Artisan') {
          steps {
            sh 'php artisan key:generate'
          }
        }

        stage('DB') {
          steps {
            sh 'php artisan migrate:fresh --seed'
          }
        }

      }
    }

    stage('Test') {
      steps {
        sh './vendor/bin/phpunit --log-junit results.xml'
      }
    }

    stage('Deploy - Staging') {
      steps {
        sh 'php artisan deploy:run deploy:unlock staging'
        sh 'php artisan deploy staging -v'
      }
    }

  }
  post {
    always {
      junit 'results.xml'
    }

  }
}
