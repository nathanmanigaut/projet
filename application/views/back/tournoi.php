<?
// Le tournoi
if ($tournaments->num_rows() >= 1) {
    foreach ($tournaments->result() as $tournament) {?>
        <div class="d-flex justify-content-center">
          <div class="col-lg-6 col-sm-6 border">
          <h2 class="text-center">Votre Tournoi</h2>
            <form method="post" action=<?=base_url('/tournoi/update_tournament')?>>
              <div class="form-group row">
              <label for="inputName" class="col-sm-2 col-form-label">Nom de votre tournoi :</label>
                <div class="col-sm-10 d-flex align-items-center">
                  <input type="name" name="name" class="form-control" value="<?=$tournament->name?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputJeuxId" class="col-sm-2 col-form-label">Jeux :</label>
              <div class="col-sm-10 d-flex align-items-center">
                <select class="form-control" name="jeux_id">
                  <?foreach ($games->result() as $game) {?>
                    <option <?if ($game->id == $tournament->jeux_id) {?>selected<?}?> value="<?=$game->id?>"><?=$game->name?></option>
                  <?}?>
                </select>
              </div>
            </div>
          <div class="form-group row">
            <label for="inputDate" class="col-sm-2 col-form-label">Date de votre tournoi :</label>
            <div class="col-sm-10 d-flex align-items-center">
              <input type="datetime-local" name="date_start" class="form-control" value="<?=$date_start?>" min="<?=$date?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputNbTeams" class="col-sm-2 col-form-label">Nombre de participant au tournoi:</label>
            <div class="col-sm-10 d-flex align-items-center">
              <?if ($tournament->nb_team == 4) {?>
                <select class="form-control" name="nb_team">
                  <option value="4" selected>4 equipes</option>
                  <option value="8">8 equipes</option>
                  <option value="16">16 equipes</option>
                  <option value="32">32 equipes</option>
                </select>
              <?} else if ($tournament->nb_team == 8) {?>
                <select class="form-control" name="nb_team">
                  <option value="4">4 equipes</option>
                  <option value="8" selected>8 equipes</option>
                  <option value="16">16 equipes</option>
                  <option value="32">32 equipes</option>
                </select>
              <?} else if ($tournament->nb_team == 16) {?>
                <select class="form-control" name="nb_team">
                  <option value="4">4 equipes</option>
                  <option value="8">8 equipes</option>
                  <option value="16" selected>16 equipes</option>
                  <option value="32">32 equipes</option>
                </select>
              <?} else if ($tournament->nb_team == 32) {?>
                <select class="form-control" name="nb_team">
                  <option value="4">4 equipes</option>
                  <option value="8">8 equipes</option>
                  <option value="16">16 equipes</option>
                  <option value="32" selected>32 equipes</option>
                </select>
              <?}?>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <button class="btn btn-primary" type="submit">Modifiez votre tournoi</button>
          </div>
        </form>
      </div>
    </div>


    <?}//Les matchs du tournoi
      if($matchs->num_rows() >= 1){?>
      
        <div class="d-flex justify-content-center">
        
        <div class="col-lg-8 col-sm-6 border">
        <h2 class="text-center">Les Matchs</h2>
        <h3 class="text-center"> Les matchs en cours</h3>
            <?foreach($matchs->result() as $match){
              if($match->team_1 != null && $match->team_2 != null){
                foreach ($teams->result() as $team){?>
                  <?if($match->team_1 == $team->id){?>
                    <div class="col-lg-12 col-sm-6 border">
                      
                      <form method="post" action=<?=base_url('/match/update_match')?>>
                        <div class="form-group row ">
                          <input type="hidden" name="match_id" value="<?=$match->id?>">
                          <label for="inputTeamsId" class="col-sm-2 col-form-label">
                            Gagnant du match :
                          </label>
                          <div class="col-sm-10 d-flex align-items-center">
                            <select class="form-control" name="winner">
                              <option value="<?=$match->team_1?>"><?=$team->name?></option>
                  <?}else if($match->team_2 == $team->id){?>
                              <option value="<?=$match->team_2?>"><?=$team->name?></option>
                            </select> 
                          </div>
                        </div>  
                        <div class="d-flex justify-content-center">
                          <button class="btn btn-primary" type="submit">Mettre à jour les matchs</button>
                        </div>
                        <??>
                      </form>    
                  <?}               
                }?> </div>
              <?} else if($match->team_1 == null && $match->team_2 == null){?>
                <h3 class="text-center"> Les matchs à venir</h3>
                <div class="row-sm-10 d-flex justify-content-center border">
                  <p> TBD vs TBD </p>
                </div>
              <?}
            }?>
             
        </div>
      </div>    
    <?}
} else {?>

    <div class="d-flex justify-content-center">
      <div class="col-lg-6 col-sm-6 border">
        <h2 class="text-center">Créer votre tournoi</h2>
        <form method="post" action=<?=base_url('tournoi/add_tournament')?>>
          <div class="form-group row">
            <label for="inputName" class="col-sm-2 col-form-label">Nom du tournoi :</label>
            <div class="col-sm-10 d-flex align-items-center">
              <input type="name" name="name" class="form-control" placeholder="Votre nom de votre tournoi">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputJeuxId" class="col-sm-2 col-form-label">Jeux :</label>
            <div class="col-sm-10 d-flex align-items-center">
              <select class="form-control" name="jeux_id">
                <?foreach ($games->result() as $game) {?>
                  <option value="<?=$game->id?>"><?=$game->name?></option>
                <?}?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputDate" class="col-sm-2 col-form-label">Date de tournoi :</label>
            <div class="col-sm-10 d-flex align-items-center">
              <input type="datetime-local" name="date_start" class="form-control" value="<?=$date?>" min="<?=$date?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputNbTeams" class="col-sm-2 col-form-label">Nombre de participant au tournoi:</label>
            <div class="col-sm-10 d-flex align-items-center">
              <select class="form-control" name="nb_team">
                <option value="4">4 equipes</option>
                <option value="8">8 equipes</option>
                <option value="16">16 equipes</option>
                <option value="32">32 equipes</option>
              </select>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <button class="btn btn-primary" type="submit">Créez votre tournoi</button>
          </div>
        </form>
      </div>
    </div>

      <?}?>
