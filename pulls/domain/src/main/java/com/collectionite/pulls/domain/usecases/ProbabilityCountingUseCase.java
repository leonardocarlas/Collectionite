package com.collectionite.pulls.domain.usecases;

import lombok.NoArgsConstructor;

@NoArgsConstructor
public class ProbabilityCountingUseCase {

    /**
     * To-do implement
     * @param valore1
     * @param valore2
     * @return
     */
    public double getProbability(int valore1, int valore2) {
        if (valore2 == 0) {
            throw new RuntimeException("Non posso dividere per zero");
        }
        return (double) valore1 / valore2;
    }
}
