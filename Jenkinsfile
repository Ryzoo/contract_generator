pipeline {
  agent any
  stages {
    stage('Install') {
      parallel {
        stage('Composer') {
          steps {
            sh 'composer install --verbose --prefer-dist --no-progress --no-interaction --optimize-autoloader --no-suggest && composer dump-autoload'
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
        branch 'master'
      }
      steps {
        sh 'curl --request POST https://forge.laravel.com/servers/347555/sites/950650/deploy/http?token=ktDQ7lliLVAfw9AFG0HzUWSctNWuilHyK9QWXntN'
      }
    }

  }
  post {
    always {
      junit 'results.xml'
    }

  }
}
