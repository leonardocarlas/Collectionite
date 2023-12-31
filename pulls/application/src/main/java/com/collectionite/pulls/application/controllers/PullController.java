package com.collectionite.pulls.application.controllers;


import com.collectionite.pulls.application.domain.models.Pull;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/api/v1/pull")
public class PullController {

    @GetMapping
    public String getAllPulls() {
        return "All the pulls";
    }

    @GetMapping("/{id}")
    public String getPullById(@PathVariable String id) {
        return String.format("You asked for pull %s", id);
    }

    @PostMapping
    public String createPull(@RequestBody Pull pull) {
        return  "Created new pull with id 209421jj32";
    }

    @PutMapping("/{id}")
    public String updatePull(@PathVariable String id, @RequestBody Pull pull) {
        return String.format("Updated pull with id %s", id);
    }

    @DeleteMapping("/{id}")
    public String deletePullById(@PathVariable String id) {
        return String.format("Deleted pull with id %s", id);
    }



}
