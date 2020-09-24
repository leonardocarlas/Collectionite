<?php

if(isset($_SESSION['idcollezione'])){
    $idcollection = $_SESSION['idcollezione'];
}
if(isset($_GET['Edit'])){

    $cardname = $_GET['name-card'];
    $setname = $_GET['name-set'];

}

else{       ?>
     
        <div class="content">
        <div class="container">
        
        <div class="row justify-content-center">
            
        <label for id="carta-inserimento"><h5><p class="font-weight-bold"> 2. Second Step.</p> If you have to insert a new card follow this procedure:</h5><br>
        <ul>
            <li>Open in another page the site of <a href="https://www.cardmarket.com/en/">https://www.cardmarket.com/en/</a>. Remember that it works only with the english version;  </li>
            <li>Search out the exact card that you want to insert;</li>
            <li>Copy the exact name of the cards and of the set from the site, then paste them in the apposites fields.</li>
            <li>To see an example of the usage, check out our video on Youtube: <a href="https://www.youtube.com/watch?v=Zw6OeYv-cKw">https://www.youtube.com/watch?v=Zw6OeYv-cKw</a>      </li>
            
        </ul>
        <br><br>
            <div class="col-12">
                <div class="card card-primary card-outline" id="carta-inserimento">
                <div class="card-header">
                    <h3 class="card-title">Add cards to your album</h3>
                </div>

        <form method="POST" action="php/cardinsert.php">
        <div class="card-body">
        <div class="row">
<!--        
        <?php

        if($idcollection == 6){ ?>
            <div class="col-4"> 
            <div class="form-group">
            <select class="form-control" name="set" title="--Set Name--" data-live-search="true" data-live-search-placeholder="Search your Set">
                <option>--Set Name--</option>
                <option>"W" Promos</option>
                <option>Ancient Origins</option>
                <option>Aquapolis</option>
                <option>Arceus</option>
                <option>Base Set</option>
                <option>Base Set 2</option>
                <option>Best of Game Cards Promos</option>
                <option>Black & White</option>
                <option>Boundaries Crossed</option>
                <option>BREAKpoint</option>
                <option>BREAKthrough</option>
                <option>Burger King DP Promos 2008</option>
                <option>Burning Shadows</option>
                <option>BW Black Star Promos</option>
                <option>BW TrainerKit</option>
                <option>Call of Legends</option>
                <option>Celestial Storm</option>
                <option>Cosmic Eclipse</option>
                <option>Crimson Invasion</option>
                <option>Dark Explorers</option>
                <option>Detective Pikachu</option>
                <option>Diamond & Pearl</option>
                <option>Double Crisis</option>
                <option>DB Black Star Promos</option>
                <option>Burger King DP Promos 2008</option>
                <option>Burning Shadows</option>
                <option>BW Black Star Promos</option>
                <option>BW TrainerKit</option>
                <option>Call of Legends</option>
                <option>Celestial Storm</option>
                <option>Cosmic Eclipse</option>
                <option>Crimson Invasion</option>
                <option>Dark Explorers</option>
                <option>Detective Pikachu</option>
                <option>Diamond & Pearl</option>
                <option>Double Crisis</option>
                <option>DP Black Star Promos</option>
                <option>DP TrainerKit</option>
                <option>Dragon Majesty</option>
                <option>Dragon Vault</option>
                <option>Dragons Exalted</option>
                <option>Emerging Powers</option>
                <option>Evolutions</option>
                <option>EX Crystal Guardians</option>
                <option>EX Delta Species</option>
                <option>EX Deoxys</option>
                <option>EX Dragon</option>
                <option>EX Dragon Frontiers</option>
                <option>EX Emerald</option>
                <option>EX FireRed & LeafGreen</option>
                <option>EX Hidden Legends</option>
                <option>EX Holon Phantoms</option>
                <option>EX Legend Maker</option>
                <option>EX Power Keepers</option>
                <option>EX Ruby & Sapphire</option>
                <option>EX Sandstorm</option>
                <option>EX Team Magma vs Team Aqua</option>
                <option>EX Team Rocket Returns</option>
                <option>EX Trainer Kit</option>
                <option>EX Trainer Kit 2</option>
                <option>EX Unseen Forces</option>
                <option>Expedition Base Set</option>
                <option>Explosive Flame Walker</option>
                <option>Fates Collide</option>
                <option>Flashfire</option>
                <option>Forbidden Light</option>
                <option>Fossil</option>
                <option>Furios Fists</option>
                <option>Generations</option>
                <option>Great Encounters</option>
                <option>Guardian Rising</option>
                <option>Gym Challenge</option>
                <option>Gym Heroes</option>
                <option>HeartGolld & SoulSilver</option>
                <option>HGSS Black Star Promos</option>
                <option>Hidden Fates</option>
                <option>HS Trainer Kit</option>
                <option>Infinity Zone</option>
                <option>Jungle</option>
                <option>League Promos</option>
                <option>Legendary Collection</option>
                <option>Legendary Heartbeat</option>
                <option>Legendary Trasures</option>
                <option>Legends Awakaned</option>
                <option>Lost Thunder</option>
                <option>Majestic Dawn</option>
                <option>McDonald"s Collection 2011</option>
                <option>McDonald"s Collection 2012</option>
                <option>McDonald"s Collection 2013</option>
                <option>McDonald"s Collection 2014</option>
                <option>McDonald"s Collection 2015</option>
                <option>McDonald"s Collection 2016</option>
                <option>McDonald"s Collection 2017</option>
                <option>McDonald"s Collection 2018</option>
                <option>McDonald"s Collection 2018 (2)</option>
                <option>McDonald"s Collection 2019</option>
                <option>McDonald"s Collection 2019 (2)</option>
                <option>Mysterious Treasures</option>
                <option>Neo Destiny</option>
                <option>Neo Discovery</option>
                <option>Neo Genesis</option>
                <option>Neo Revelation</option>
                <option>Next Destinies</option>
                <option>Nintendo Black Star Promos</option>
                <option>Noble Victories</option>
                <option>Oversized Promos</option>
                <option>Phantom Forces</option>
                <option>Plasma Blast</option>
                <option>Plasma Freeze</option>
                <option>Plasma Storm</option>
                <option>Platinum</option>
                <option>Pokemon Products</option>
                <option>Pokemon Rumble</option>
                <option>Pop Series 1</option>
                <option>Pop Series 2</option>
                <option>Pop Series 3</option>
                <option>Pop Series 4</option>
                <option>Pop Series 5</option>
                <option>Pop Series 6</option>
                <option>Pop Series 7</option>
                <option>Pop Series 8</option>
                <option>Pop Series 9</option>
                <option>Primal Clash</option>
                <option>Professor Program</option>
                <option>Promos</option>
                <option>Rebel Clash</option>
                <option>Rebellion Crash</option>
                <option>Rising Rivals</option>
                <option>Roaring Skies</option>
                <option>Secret Wonders</option>
                <option>Shield</option>
                <option>Shining Legends</option>
                <option>Skyridge</option>
                <option>SM Black Star Promos</option>
                <option>SM Trainer Kit: Alolan Sandlash & Alolan Ninetales</option>
                <option>SM Trainer Kit: Lyncaroc & Alolan Raichu</option>
                <option>Southern Islands</option>
                <option>Steam Siege</option>
                <option>Stormfront</option>
                <option>Sun & Moon</option>
                <option>Sun & Moon Promos</option>
                <option>Supreme Victors</option>
                <option>Sword</option>
                <option>Sword & Shield</option>
                <option>Sword & Shield Promos</option>
                <option>SWSH Black Star Promos</option>
                <option>Team Rocket</option>
                <option>Team Up</option>
                <option>Triumphant</option>
                <option>Secret Wonders</option>
                <option>Shield</option>
                <option>Shining Legends</option>
                <option>Skyridge</option>
                

            </select>
           </div>
           </div>

        <?php
        }elseif($idcollection == 3){   ?>

            <div class="col-4"> 
            <div class="form-group">
            <select name="set" class="form-control">
                <option>--Set Name--</option>
                <option>2-Player Starter Deck Yuya & Declan</option>
                <option>2013 Zexal Collection Tin</option>
                <option>2014 Mega Tins</option>
                <option>2014 Mega-Tins Mega Pack</option>
                <option>2015 Mega Tins</option>
                <option>2015 Mega-Tins Mega Pack</option>
                <option>2016 Mega Tins</option>
                <option>2016 Mega-Tins Mega Pack</option>
                <option>2017 Mega Tins</option>
                <option>2017 Mega-Tins Mega Pack</option>
                <option>2018 Mega Tins</option>
                <option>2018 Mega-Tins Mega Pack</option>
                <option>2019 Gold Sarcophagus Tin</option>
                <option>2019 Gold Sarcophagus Tin Mega Pack</option>
                <option>3D Bonds Beyond Time Movie Pack</option>
                <option>5D s Duel Transer Promotional Cards</option>
                <option>5D s Manga Promos</option>
                <option>5D s Over the Nexus Promotional Cards</option>
                <option>5D s Reverse of Arcadia Promotional Cards</option>
                <option>5D s Stardust Accelarator Promotional Cards</option>
                <option>5D s Tag Force 4 Promotional Cards</option>
                <option>5D s Tag Force 5 Promotional Cards</option>
                

            </select>
            </div>
            </div>
            
        <?php 

        }elseif($idcollection == 1){  ?>
            <div class="col-4"> 
            <div class="form-group">
            <select name="set" class="form-control">
                <option>--Set Name--</option>
                <option>2005 Player Cards</option>
                <option>2006 Player Cards</option>
                <option>2007 Player Cards</option>
                <option>Aaron Miller Tokens</option>
                <option>Aether Revolt</option>
                <option>Aether Revolt: Promos</option>
                <option>Alara Reborn</option>
                <option>Aliances</option>
                <option>Alpha</option>
                <option>ALRadeck Tokens</option>
                <option>Amaranth Alchemy Tokens</option>
                <option>Amonkhet</option>
                <option>Amonkhet Invocations</option>
                <option>Amonkhet: Promos</option>
                <option>Andrew Thompson Tokens</option>
                <option>Angelarium Tokens</option>
                <option>Anthologies</option>
                <option>Anthony Critou Tokens</option>
                <option>Antiquities</option>
                
                

            </select>
            </div>
            </div>
        
        <?php    

        }elseif($idcollection == 8){  ?>
            <div class="col-4"> 
            <div class="form-group">
            <select name="set" class="form-control">
                <option>--Set Name--</option>
                <option>Absolute Judgment</option>
                <option>Academy of Divas</option>
                <option>Aerial Steed Liberation</option>
                <option>Astral Plane Markers</option>
                <option>Awakening of Twin Blades</option>
                <option>Banquet of Divas</option>
                <option>Binding Force of the Black Rings</option>
                <option>Blazing Perdition ver.E</option>
                <option>Blessing of Divas</option>
                <option>Blue Storm Armada</option>
                <option>Breaker of Limits</option>
                <option>Brilliant Strike</option>
                <option>Catastrophic Outbreak</option>
                <option>Cavalry of Black Steel</option>
                <option>Celestial Valkyries</option>
                <option>Champions of the Asia Circuit</option>
                <option>Champions of the Cosmos</option>
                <option>Clash of the Knights & Dragons</option>
                <option>Cosmic Style Vol. 1</option>
                
                

            </select>
            </div>
            </div>
        
        <?php

        }elseif($idcollection == 7){  ?>
            <div class="col-4">
            <div class="form-group">
            <select name="set" class="form-control">
                <option>--Set Name--</option>
                <option>Advent of the Demon King</option>
                <option>Alice Origin</option>
                <option>Alice Origin II</option>
                <option>Alice Origin III</option>
                <option>Ancient Nights</option>
                <option>Awakening of the Ancients</option>
                <option>Basic Rulers</option>
                <option>Battle of Attoractia</option>
                <option>Buy-a-box Promos</option>
                <option>Curse of the Frozen Casket</option>
                <option>Echoes of the New World</option>
                <option>Force of Will Half Deck</option>
                <option>Ghost in the Shell: SAC_2045</option>
                <option>Judge Promos</option>
                <option>Legacy Lost</option>
                <option>Life Points Tokens</option>
                <option>Memoria Promos</option>
                <option>Misprints</option>
                <option>New Dawn Rises</option>
                
                

            </select>
            </div>
            </div>

        <?php } elseif($idcollection == 2){  ?>
            <div class="col-4">
            <div class="form-group">
            <select name="set" class="form-control">
                <option>--Set Name--</option>
                <option>2011 Showdown: Goblins of Anarchy</option>
                <option>Aren Grand Melee</option>
                <option>Assault on Icecrown Citadel</option>
                <option>Badge of Justice</option>
                <option>Battle of the Aspects</option>
                <option>Betrayal of the Guardian</option>
                <option>Balcke Temple Raid Deck</option>
                <option>Blood of Gladiators</option>
                <option>Burning Crusade Promos</option>
                <option>Cataclysm Promos</option>
                <option>Caverns of Time</option>
                <option>Champion Decks</option>
                <option>Class Starter Decks 2010</option>
                <option>Class Starter Decks Fall 2011</option>
                <option>Class Starter Decks Spring 2013</option>
                <option>Crafting Material Cards</option>
                <option>Crafting Rewards Promos</option>
                <option>Crown of the Heavens</option>
                
                
                

            </select>
            </div>
            </div>
        
    <?php } elseif($idcollection == 15){  ?>
        <div class="col-4">
        <div class="form-group">
        <select name="set" class="form-control">
            <option>--Set Name--</option>
            <option>Across the Galaxy</option>
            <option>Allies of Necessity</option>
            <option>Awakenings</option>
            <option>Convergence</option>
            <option>Convert Missions</option>
            <option>Empire at War</option>
            <option>Legacies</option>
            <option>Promos</option>
            <option>Rivals</option>
            <option>Spark of Hope</option>
            <option>Spirit of Rebellion</option>
            <option>Two-Player Game</option>
            <option>Way of the Force</option>
            <option>World hampionship Promos</option>

        </select>
        </div>
        </div>

    <?php } elseif($idcollection == 11){  ?>
       
        <div class="col-4">
        <div class="form-group">
        <select name="set" class="form-control">
            <option>--Set Name--</option>
            <option>Demo Deck</option>
            <option>Gears of Apocalypse</option>
            <option>Oath of Blood</option>
            <option>Promos</option>
            <option>Rally to War</option>
            <option>Reckoning of Vashr</option>
            <option>Surge of Titans</option>
            <option>Trial Deck: Alpha Dominance</option>
            <option>Trial Deck: Mystical Hunters</option>
            <option>Trial Deck: Nature s Wrath</option>
            <option>Trial Deck: Reaper s Gift</option>
            <option>Trial Deck: Shadow Legion</option>
            

        </select>
        </div>
        </div>
    
    <?php } elseif($idcollection == 12){ ?>
       
        <div class="col-4">
        <div class="form-group">
        <select name="set" class="form-control">
            <option>--Set Name--</option>
            <option>Absolute Discord</option>
            <option>Canterlot Nights</option>
            <option>Celestial Solstice</option>
            <option>Defenders of Equestria</option>
            <option>Equestrians Odysseys</option>
            <option>Friends Forever</option>
            <option>GenCon Demo</option>
            <option>High Magic</option>
            <option>Marks in Time</option>
            <option>Premiere</option>
            <option>Promos</option>
            <option>Rock N Rave</option>
            <option>Seaquestria and Beyond</option>
            <option>The Crystal Games</option>
            

        </select>
        </div>
        </div>
    
    <?php } elseif($idcollection == 13){  ?>
       
        <div class="col-4">
        <div class="form-group">
        <select name="set" class="form-control">
            <option>--Set Name--</option>
            <option>Assault of the Saiyans</option>
            <option>Clash of Fates</option>
            <option>Colossal Warfare</option>
            <option>Cross Worlds</option>
            <option>Destroyer Kings</option>
            <option>Divine Multiverse</option>
            <option>Divine Multiverse Realese Promos</option>
            <option>Dragon Brawl</option>
            <option>Dragon Brawl Realese Promos</option>
            <option>Expansion Set: Dark Demon s Villains</option>
            <option>Expansion Set: Mighty Heroes</option>
            <option>Expansion Set: Namekian Surge</option>
            <option>Expansion Set: Sayan Surge</option>
            <option>Expansion Set: Special Anniversary Box</option>
            <option>Expansion Set: Ultimate Box</option>
            <option>Expansion Set: CICCIO PASTICCIOS</option>
            <option>Expansion Set: Mighty Heroes</option>
            <option>Expansion Set: Namekian Surge</option>
            <option>Expansion Set: Sayan Surge</option>
            <option>Expansion Set: Special Anniversary Box</option>
            <option>Expansion Set: Ultimate Box</option>
            

        </select>
        </div>
        </div>

    <?php } elseif($idcollection == 10){  ?>
       
        <div class="col-4">
        <div class="form-group">
        <select name="set" class="form-control">
            <option>--Set Name--</option>
            <option>Angel Beats! Re:Edit</option>
            <option>Attack on Titan</option>
            <option>Attack on Titan: Vol.2</option>
            <option>Bakemonogatari</option>
            <option>BanG Dream!</option>
            <option>BanG Dream! Girls Band Party!</option>
            <option>BanG Dream! Girls Band Party! 2</option>
            <option>BanG Dream! Girls Band Party! MULTI LIVE</option>
            <option>BanG Dream! Vol.2</option>
            <option>Batman Ninja</option>
            <option>BWC Promos</option>
            <option>Cardcaptor Sakura: Clear Card</option>
            <option>Disgaea</option>
            <option>Disgaea (Starter Deck)</option>
            <option>Fairy Tail</option>
            <option>Fate/Apocrypha</option>
            <option>Fate/kaleiid liner Prisma lllyda DX</option>
            <option>Fate/stay night</option>
            <option>Fate/stay night:Heaven s Feel</option>
            <option>Fate/stay night:Vol.2</option>
            

        </select>
        </div>
        </div>
    
    <?php } elseif($idcollection == 5){  ?>
       
        <div class="col-4">
        <div class="form-group">
        <select name="set" class="form-control">
            <option>--Set Name--</option>
            <option>First Edition</option>
            <option>First Edition Part 2</option>
            <option>Holy Heist</option>
            <option>Open Beta</option>
            <option>Promos</option>
            <option>Second Edition</option>
            <option>Seed</option>
            <option>Seed 2</option>
            <option>Seed 3</option>
            <option>Seed Saga: The Descent of Gideon</option>
            <option>Shade of the Devoured Emperor</option>
            <option>The Decade of Deckadence</option>
            <option>Ungodly Mess</option>
            

        </select>
        </div>
        </div>

     <?php }  elseif($idcollection == 9){  ?>
       
        <div class="col-4">
        <div class="form-group">
        <select name="set" class="form-control">
            <option>--Set Name--</option>
            <option>Opus I</option>
            <option>Opus II</option>
            <option>Opus III</option>
            <option>Opus IV</option>
            <option>Opus IX: Lords & Chaos</option>
            <option>Opus V</option>
            <option>Opus VI</option>
            <option>Opus VII</option>
            <option>Seed VIII</option>
            <option>Seed X: Ancient Champions</option>
            <option>Seed XI: Soldier s Return:</option>

        </select>
        </div>
        </div>
    
    <?php   }    ?>

-->

        <div class="col-4">
        <div class="form-group">
            <input class="form-control" type="text" name="set_name"  placeholder="Exact Set name in English">
        </div>
        </div>

        <div class="col-4">
        <div class="form-group">
            <input class="form-control" type="text" name="card_name"  placeholder="Exact Card Name in English">
        </div>
        </div>
            
              

        <div class="col-4">
        <div class="form-group">
            <select name="conditions" class="form-control">
                <option>--Conditions--</option>
                <option>M</option>
                <option>NM</option>
                <option>EX</option>
                <option>GD</option>
                <option>LP</option>
                <option>PL</option>
                <option>P</option>
            </select>
        </div>
        </div>
        </div>

        <div class="row">       
        <div class="col-4"> 
        <div class="form-group">
            <select name="extravalues" class="form-control">
                <option>--Extra Values--</option>
                <option>Normal</option>
                <option>Foil</option>
                <option>Holo Reverse</option>
                <option>Cosmo Holo</option>
                <option>First Edition</option>
                
            </select>
        </div>
        </div>

        <div class="col-4"> 
        <div class="form-group">
            <select name="languages" class="form-control">
                <option>--Languages--</option>
                <option>Italian</option>
                <option>English</option>
                <option>Spanish</option>
                <option>German</option>
                <option>French</option>
                <option>Portuguese</option>
                <option>Russian</option>
                <option>Korean</option>
                <option>Japanese</option>
                <option>Traditional Chinese</option>
                <option>Simplified Chinese</option>
            </select>
        </div>
        </div>

        
        <div class="col-4"> 
        <div class="form-group">
            <select name="quantities" class="form-control">
                <option>--Quantities--</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
        </div>
        </div>
        <div class="row justify-content-center mt-2">
            <div class="col-3">
                <input class="btn btn-primary btn-block" type="submit" name="inserisci-carta" value="Insert Card">
            </div>
        </div>
            
        </form>
        </div>

        <?php if(isset($_POST['selected-min&trend']) || isset($_POST['selected-evaluation'])) {  ?>
                <div class="card-footer">
                    <h5><p class="font-weight-bold">3. Third Step.</p> To see your collection click the button below. </h5>
                    
                    <form method="POST" action="php/get_cards.php">    
                        <input class="btn btn-info" type="submit" name="aggiorna_carte" value="Reload Cards">
                    </form>
                </div>
        <?php  }  ?>

    </div>
    </div>
    </div>
    </div>

<?php   }   ?>


        