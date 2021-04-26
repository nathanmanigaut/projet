<?

foreach($tournaments->result() as $tournament){?>

    <div class="d-flex justify-content-around">
        <div class="col-lg-8 col-sm-6 border">
            <h1 class="text-center"><?=$tournament->name?></h1>
            <div class="d-flex justify-content-center">
                <?foreach($games->result() as $game){?>
                    <?if($tournament->jeux_id == $game->id){?>   
                        <p>Jeux du tournoi : <?=$game->name?></p>
                    <?}?>        
                <?}?>
            </div>
            <div class="d-flex justify-content-center">
                <p>Participants : <?=$registered->num_rows()?>/<?=$tournament->nb_team?></p>
            </div>
            <div class="d-flex justify-content-center">
                <p>Nombre de place dans le tournoi : <?=$tournament->nb_team?></p>
            </div>   
            <div class="d-flex justify-content-center">
                <p>Date du tournoi : <?=$date_start?></p>
            </div>   
            <?if($registered->num_rows() < $tournament->nb_team) {?>
                <form method="post" action="http://localhost/projet/tournoi/register_tournament">
                    <div class="d-flex justify-content-center">
                        <input type="hidden" name="tournament_id" value="<?=$tournament->id?>">
                        <button class="btn btn-primary" type="submit">Inscrire votre equipe au tournoi</button>
                    </div>
                </form>
            <?}else {?>
                <div class="d-flex justify-content-center"> 
                    <p>Tournoi complet</p>
                </div>
            <?}?>
        </div>
        <div class="col-lg-4 col-sm-4 border">
            <div class="d-flex justify-content-center">
                <p>Equipe Inscrite :</p>
            </div>
            <?foreach($registered->result() as $register){?>
                <?foreach($teams->result() as $team){?>
                    <div class="d-flex justify-content-center border">
                        <?if($register->team_id == $team->id){?>
                            <p><?=$team->name?></p>
                        <?}?>
                    </div>
                <?}?>
            <?}?> 
        </div>    
    </div>        
<?}?>