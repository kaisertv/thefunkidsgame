<div class="row">
      <div class="col-lg-12">
          <div class="new-story purple-bg" style="width:98.8%">
          <h2> NEW <span>RHYMES</span> </h2>
          <div class="row">
          <?php 
          $kid_rhymes=getAllKidsRhymes();
          if($kid_rhymes>0)
          { 
              while($kid_rhyme=mysql_fetch_array($kid_rhymes))
              {         
          ?>  
              <a href="kids-rhymes-<?php echo $kid_rhyme['rhyme_seo']; ?>">
            <div class="col-md-2"> <img src="rhymes/<?php echo $kid_rhyme['rhyme_image']; ?>" alt="" class="img-responsive"/>
              <p class="puzzle-paras" align="center"> <?php echo $kid_rhyme['rhyme_name']; ?> </p>
            </div>
              </a>     
          <?php
          }
          }
          ?>
              </div>
        </div>
      </div>
    </div>

<div class="row">
      <div class="col-lg-12">
        <div class="new-story" style="width:98.8%">
          <h2> NEW <span>Games</span> </h2>
          <div class="row">
          <?php 
          $kid_stories=  getAllNewGames();
          if($kid_stories>0)
          {
              while($kid_story=  mysql_fetch_array($kid_stories))
              {
          ?>    
              <a href="kids-games-<?php echo $kid_story['seo_game'];  ?>"  onClick="ga('send', 'event', 'Kids <?php echo $kid_story['game_name']; ?>', 'Play Kids <?php echo $kid_story['game_name']; ?>');">
            <div class="col-md-2"> <img src="games/game_images/<?php echo $kid_story['game_image']; ?>" alt="" class="img-responsive"/>
              <p class="puzzle-paras" align="center"> <?php echo $kid_story['game_name']; ?>  </p>
            </div> 
              </a>
          <?php
          }
          }
          ?>
              <a href="">
            <div class="col-md-2"> <img src="funkid-puzzles/puzzle_images/coming-soon-1.jpg" alt="" class="img-responsive"/>
              <p class="puzzle-paras" align="center"> Coming Soon..  </p>
            </div>
              </a>
              <a href="">
            <div class="col-md-2"> <img src="funkid-puzzles/puzzle_images/coming-soon-1.jpg" alt="" class="img-responsive"/>
              <p class="puzzle-paras" align="center"> Coming Soon..  </p>
            </div>
              </a>
          </div>
          
        </div>
      </div>
    </div>
<div class="row">
      <div class="col-lg-12">
        <div class="new-puzzle" style="width:98.8%">
          <h2> NEW <span>PUZZLES</span> </h2>
          <div class="row">
            <?php 
            $kid_puzzles=getAllKidPuzzles();
            if($kid_puzzles>0)
            {
              while($kid_puzzle=  mysql_fetch_array($kid_puzzles))
              {
            ?>
            <a href="kid-puzzle-<?php echo $kid_puzzle['seo_puzzle'];  ?>"  onClick="ga('send', 'event', 'Kids Puzzle <?php echo $kid_puzzle['puzzle_name']; ?> ', 'Play Kids Puzzle <?php echo $kid_puzzle['puzzle_name']; ?>');">
            <div class="col-md-2"> <img src="funkid-puzzles/puzzle_images/<?php echo $kid_puzzle['puzzle_image']; ?> " alt="" class="img-responsive"/>
              <p class="puzzle-paras" align="center"> <?php echo $kid_puzzle['puzzle_name']; ?>  </p>
            </div>
              </a>
            <?php
            }
            }
            ?>   
              
              
              
          </div>
        </div>
      </div>
    </div>


