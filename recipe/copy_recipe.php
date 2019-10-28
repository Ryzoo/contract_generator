<?php

namespace Deployer;

task('copy', "cp -LRf ../../current ../../public_html/actual 2>/dev/null");
