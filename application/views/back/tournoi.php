<? 

$user_id = $this->session->id;
$key = 'create_id';
$query = $this->tournoi->selects('*', $key, $user_id);
$date = date('Y-m-d\TH:i');
$jeux = $this->game->gets();

if($query->num_rows() >= 1 ){
  
      foreach($query->result() as $tournament){?>
      <?$date_start = date_create($tournament->date_start);
      $date_start = $date_start->format('Y-m-d\TH:i')?>
        <div class="d-flex justify-content-center">
          <div class="col-lg-6 col-sm-6 border">
          <h4 class="text-center">Votre Tournoi</h4>  
            <form method="post" action="http://localhost/projet/tournoi/update_tournament"> 
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
                  <?foreach($jeux->result() as $jeu){?>
                    <option <?if($jeu->id == $tournament->jeux_id){?>selected<?}?> value="<?=$jeu->id?>"><?=$jeu->name?></option>
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
              <?if($tournament->nb_team == 4){?>
                <select class="form-control" name="nb_team">
                  <option value="4" selected>4 equipes</option>
                  <option value="8">8 equipes</option>
                  <option value="16">16 equipes</option>
                  <option value="32">32 equipes</option>
                  <option value="64">64 equipes</option>
                </select>
              <?} else if($tournament->nb_team == 8){?>
                <select class="form-control" name="nb_team">
                  <option value="4">4 equipes</option>
                  <option value="8" selected>8 equipes</option>
                  <option value="16">16 equipes</option>
                  <option value="32">32 equipes</option>
                  <option value="64">64 equipes</option>
                </select>
              <?} else  if($tournament->nb_team == 16){?>
                <select class="form-control" name="nb_team">
                  <option value="4">4 equipes</option>
                  <option value="8">8 equipes</option>
                  <option value="16" selected>16 equipes</option>
                  <option value="32">32 equipes</option>
                  <option value="64">64 equipes</option>
                </select>
              <?} else  if($tournament->nb_team == 32){?>
                <select class="form-control" name="nb_team">
                  <option value="4">4 equipes</option>
                  <option value="8">8 equipes</option>
                  <option value="16">16 equipes</option>
                  <option value="32" selected>32 equipes</option>
                  <option value="64">64 equipes</option>
                </select>
              <?} else  if($tournament->nb_team == 64){?>
                <select class="form-control" name="nb_team">
                  <option value="4">4 equipes</option>
                  <option value="8">8 equipes</option>
                  <option value="16">16 equipes</option>
                  <option value="32">32 equipes</option>
                  <option value="64" 64>64 equipes</option>
                </select>
              <? }?>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <button class="btn btn-primary" type="submit">Modifiez votre tournoi</button>
          </div>
        </form>
      </div>
    </div>

    
      <?}
      } else {?>

    <div class="d-flex justify-content-center">
      <div class="col-lg-6 col-sm-6 border">
        <h4 class="text-center">Créer votre tournoi</h4>
        <form method="post" action="http://localhost/projet/tournoi/add_tournament"> 
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
                <?foreach($jeux->result() as $jeu){?>
                  <option value="<?=$jeu->id?>"><?=$jeu->name?></option>
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
                <option value="64">64 equipes</option>
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
     