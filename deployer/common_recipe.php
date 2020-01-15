<?php

namespace Deployer;


task('symlink', "rm -f ../../public_html/ && ln -s ../../current ../../public_html");
