<?php

namespace Deployer;


task('symlink', "rm -rf ../../public_html && ln -s ~/domains/generatorumowy.pl/current/public ~/domains/generatorumowy.pl/public_html");
