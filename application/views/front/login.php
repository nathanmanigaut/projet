
    <div class="d-flex justify-content-center">
      <div class="col-lg-4 col-sm-4 border">
        <h4 class="text-center">Pas encore inscrit? Créer un compte ici </h4>
        <form method="post" action=<?=base_url('login/signin')?>> 
          <div class="form-group row">
            <label for="inputName" class="col-sm-2 col-form-label">Pseudo :</label>
            <div class="col-sm-10">
              <input type="name" name="name" class="form-control" id="inputName1" placeholder="Votre pseudonyme">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email :</label>
            <div class="col-sm-10">
              <input type="email" name="email" class="form-control" id="inputEmail1" placeholder="Votre adresse email">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Mot de passe :</label>
            <div class="col-sm-10">
              <input type="password" name="password" class="form-control" id="inputPassword1" placeholder="Votre mot de passe">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Confirmer votre mot de passe :</label>
            <div class="col-sm-10 d-flex align-items-center">
              <input type="password" name="password_confirm" class="form-control" id="inputPassword2" placeholder="Votre mot de passe">
            </div>
          </div>  
          <div class="d-flex justify-content-center">
            <button class="btn btn-primary" type="submit">S'inscrire</button>
          </div>
        </form>
      </div>
      <div class="col-lg-4 col-sm-4 border align-self-center">
          <h4 class="text-center">Déjà inscrit? Connectez vous ici </h4>
        
          <form class="form-group" method="post" action=<?=base_url('login/connect')?>>
            <div class="form-group row">
            <label for="inputName" class="col-sm-2 col-form-label">Pseudo :</label>
              <div class="col-sm-10">
                <input type="name" name="name" class="form-control" id="inputName2" placeholder="Votre pseudonyme">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-2 col-form-label">Mot de passe :</label>
              <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Votre mot de passe">
              </div>
            </div>  
            <div class="d-flex justify-content-center">
              <button class="btn btn-primary" type="submit">Se connecter</button>
            </div>
          </div>
        </form>
      </div>
    </div>
   