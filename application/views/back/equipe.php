<? 

$user_id = $this->session->id;
$key = 'captain_id';
$query = $this->team->selects('*', $key, $user_id);
$jeux = $this->game->gets();

        if($query->num_rows() >= 1 ){
        foreach($query->result() as $team){
?>

    <div class="d-flex justify-content-center">
      <div class="col-lg-6 col-sm-4 border">  
      <h4 class="text-center">Votre Equipe </h4>
        <form method="post" action="http://localhost/projet/equipe/update_team"> 
          <div class="form-group row">
            <label for="inputName" class="col-sm-2 col-form-label">Nom de l'equipe :</label>
            <div class="col-sm-10 d-flex align-items-center">
              <input type="name" name="name" class="form-control" id="inputName3" value="<?=$team->name?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputJeuxId" class="col-sm-2 col-form-label">Jeux :</label>
            <div class="col-sm-10 d-flex align-items-center">
              <select class="form-control" name="jeux_id">
                <?foreach($jeux->result() as $jeu){?>
                  <option <?if($jeu->id == $team->jeux_id){?> selected <?}?> value="<?=$jeu->id?>"><?=$jeu->name?></option>
                <?}?>
              </select>
            </div>
          </div>
          <div class="d-flex justify-content-center">
          <button class="btn btn-primary" type="submit">Modifiez votre equipe</button>
          </div>
        </form>
      </div>
      </div>

      <?}
    } else {?>

    <div class="d-flex justify-content-center">
      <div class="col-lg-6 col-sm-4 border">
      <h4 class="text-center">Créer votre equipe </h4>
        <form method="post" action="http://localhost/projet/equipe/add_team"> 
          <div class="form-group row">
            <label for="inputName" class="col-sm-2 col-form-label">Nom de l'equipe :</label>
            <div class="col-sm-10 d-flex align-items-center">
              <input type="name" name="name" class="form-control" id="inputName3" placeholder="Votre nom d'equipe">
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
          <div class="d-flex justify-content-center">
            <button class="btn btn-primary" type="submit">Créez votre equipe</button>
          </div>
        </form>
      </div>
    </div>

      <?}?>