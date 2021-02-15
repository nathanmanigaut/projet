
    <div class="d-flex justify-content-center">
      <div class="col col-lg-4 border">
        <h4 class="text-center">Pas encore inscrit? Créer un compte ici </h4>
        <form method="post" action="http://localhost/projet/login/signin"> 
          <div class="form-group row">
            <label for="inputName3" class="col-sm-2 col-form-label">Pseudo :</label>
            <div class="col-sm-10">
              <input type="name" name="name" class="form-control" id="inputName3" placeholder="Votre pseudonyme">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Email :</label>
            <div class="col-sm-10">
              <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Votre adresse email">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Password :</label>
            <div class="col-sm-10">
              <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Votre mot de passe">
            </div>
          </div>
          <button class="btn btn-primary" type="submit">S'inscrire</button>
        </form>
      </div>
      <div class="col col-lg-4 border">
        <h4 class="text-center">Déjà inscrit? Connectez vous ici </h4>
        <form class="form-group" method="post" action="http://localhost/projet/login/connect">
          <div class="form-group row">
          <label for="inputName3" class="col-sm-2 col-form-label">Pseudo :</label>
            <div class="col-sm-10">
              <input type="name" name="name" class="form-control" id="inputName3" placeholder="Votre pseudonyme">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Password :</label>
            <div class="col-sm-10">
              <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Votre mot de passe">
            </div>
          </div>
        <button class="btn btn-primary" type="submit">Se connecter</button>
        </form>
      </div>
    </div>
   