package com.collectionite.pulls.application.controllers;


//import com.collectionite.pulls.domain.models.Pull;
import org.springframework.web.bind.annotation.*;


@RestController
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
    public String createPull(@RequestBody String s) {
        return  "Created new pull with id 209421jj32";
    }

    @PutMapping("/{id}")
    public String updatePull(@PathVariable String id, @RequestBody String s) {
        return String.format("Updated pull with id %s", id);
    }

    @DeleteMapping("/{id}")
    public String deletePullById(@PathVariable String id) {
        return String.format("Deleted pull with id %s", id);
    }



}
