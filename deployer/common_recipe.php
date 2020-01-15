<?php

namespace Deployer;


task('symlink', "rm -rf ../../public_html/ && ln -s ../../current/public ../../public_html");
