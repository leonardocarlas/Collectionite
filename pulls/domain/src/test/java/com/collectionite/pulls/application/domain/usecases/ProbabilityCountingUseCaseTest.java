package com.collectionite.pulls.application.domain.usecases;

import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.Test;

import static org.junit.jupiter.api.Assertions.*;

public class ProbabilityCountingUseCaseTest {
    private static ProbabilityCountingUseCase useCase;

    @BeforeAll
    public static void init() {
        useCase = new ProbabilityCountingUseCase();
    }
    @Test
    public void entrambiINumeriValorizzati() {
        double res = useCase.getProbability(10, 5);

        assertEquals(2, res);
    }

    @Test
    public void primoNumeroValorizzatoESecondoAZero() {
        RuntimeException thrown = assertThrows(
                RuntimeException.class,
                () -> useCase.getProbability(10 ,0));

        assertTrue(thrown.getMessage().contains("Non posso dividere per zero"));
    }

    @Test
    public void entrambiINumeriAZero() {
        RuntimeException thrown = assertThrows(
                RuntimeException.class,
                () -> useCase.getProbability(0,0));

        assertTrue(thrown.getMessage().contains("Non posso dividere per zero"));
    }
}