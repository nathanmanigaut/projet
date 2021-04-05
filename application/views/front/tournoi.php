<?
$key = 'id';
$tournament_id = 'tournament_id';
$query = $this->tournoi->selects('*', $key, $id);
$games = $this->game->gets();
$registered = $this->registered->selects('*', $tournament_id, $id);
$teams= $this->team->gets();
foreach($query->result() as $tournoi){
    $date_start = date_create($tournoi->date_start);
    $date_start = $date_start->format('d/m/Y H\hi')?>

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
                <p>Participants : <?=$registered->num_rows()?>/<?=$tournoi->nb_team?></p>
            </div>
            <div class="d-flex justify-content-center">
                <p>Nombre de place dans le tournoi : <?=$tournoi->nb_team?></p>
            </div>   
            <div class="d-flex justify-content-center">
                <p>Date du tournoi : <?=$date_start?></p>
            </div>   
            <?if($registered->num_rows() < $tournoi->nb_team) {?>
                <form method="post" action="http://localhost/projet/tournoi/register_tournament">
                    <div class="d-flex justify-content-center">
                        <input type="hidden" name="tournament_id" value="<?=$tournoi->id?>">
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