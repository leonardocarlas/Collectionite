package com.collectionite.pulls.application.domain.models;

import lombok.*;

import java.util.List;

@Getter
@Setter
@NoArgsConstructor
@AllArgsConstructor
@Builder
@ToString
public class Pull {

    private String pullId;
    private Integer cardsNumber;
    private List<Integer> cardsIds;
    private Integer expansionId;
    private Integer gameId;
}
