<?
$key = 'id';
$tournament_id = 'tournament_id';
$query = $this->tournoi->selects('*', $key, $id);
$games = $this->game->gets();
$registered = $this->registered->selects('*', $tournament_id, $id);
$teams= $this->team->gets();
foreach($query->result() as $tournoi){?>


    <div class="d-flex justify-content-around">
        <div class="col-lg-8 col-sm-6 border">
            <h1 class="text-center"><?=$tournoi->name?></h1>
            <div class="d-flex justify-content-center">
                <?foreach($games->result() as $game){?>
                    <?if($tournoi->jeux_id == $game->id){?>   
                        <p>Jeux du tournoi : <?=$game->name?></p>
                    <?}?>        
                <?}?>
            </div>
            <div class="d-flex justify-content-center">
                <p>Participants : <?=$registered->num_rows()?>/<?=$tournoi->max_team?>
            </div>
            <div class="d-flex justify-content-center">
                <p>Minimum de participants : <?=$tournoi->min_team?>
            </div>   
            <form method="post" action="http://localhost/projet/tournoi/register_tournament">
                <div class="d-flex justify-content-center">
                <input type="hidden" name="tournament_id" value="<?=$tournoi->id?>">
                <button class="btn btn-primary" type="submit">Inscrire votre equipe au tournoi</button>
                </div>
            </form>
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