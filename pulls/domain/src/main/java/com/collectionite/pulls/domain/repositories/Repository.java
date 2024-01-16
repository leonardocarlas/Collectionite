package com.collectionite.pulls.domain.repositories;

import com.collectionite.pulls.domain.exceptions.DataNotFoundException;

import java.util.List;

public interface Repository<T> {

    public T add();

    // Può lanciare la data not found exception
    public T findById(String id);

    public List<T> findAll();

    // Può lanciare la data not found exception
    public T update(T data);

    public Boolean deleteById(String id);

    public Boolean existsById(String id);

}
