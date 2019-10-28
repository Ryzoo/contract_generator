<?php

namespace Deployer;

task('copy', "rm -rf ../../public_html/actual && cp -LRf ../../current ../../public_html/actual 2>/dev/null");
