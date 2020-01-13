pipeline {
  agent any
  stages {
    stage('Install') {
      parallel {
        stage('Composer') {
          steps {
            sh '''composer install
composer dump-autoload'''
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

    stage('Question') {
      steps {
        input 'Deploy to production?'
      }
    }

    stage('Deploy - Production') {
      when {
          branch 'dev'
      }
      steps {
        sh 'php artisan -v deploy:run deploy:unlock production -n -v'
        sh 'php artisan -v deploy production -n -v'
      }
    }

  }
  post {
    always {
      junit 'results.xml'
    }

  }
}
