<?php

    abstract class Middleware {
        public abstract function run($req, $res);
    }