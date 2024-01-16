package com.collectionite.pulls.application.controllers;

public enum Routes {

    private Routes(String s) {
    }
     DEFAULT_ROUTE("/api/v1/");

     PULL_ROUTE("/api/v1/pull");

     EXPANSION_ROUTE("/api/v1/expansion");


}
