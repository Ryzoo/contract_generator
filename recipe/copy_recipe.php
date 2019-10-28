<?php

namespace Deployer;

task('copy', "cp -LR ../../current ../../public_html/actual 2>/dev/null");
