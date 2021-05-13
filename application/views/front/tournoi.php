<?
//Le tournoi
foreach ($tournaments->result() as $tournament) {?>

    <div class="d-flex justify-content-around border">
        <div class="col-lg-8 col-sm-6 border">
            <h2 class="text-center"><?=$tournament->name?></h2>
            <div class="row justify-content-center">
                <?foreach ($games->result() as $game) {?>
                    <?if ($tournament->jeux_id == $game->id) {?>
                        <p>Jeux du tournoi : <?=$game->name?></p>
                    <?}?>
                <?}?>
            </div>
            <div class="row justify-content-center">
                <p>Participants : <?=$registered->num_rows()?>/<?=$tournament->nb_team?></p>
            </div>
            <div class="row justify-content-center ">
                <p>Nombre de place dans le tournoi : <?=$tournament->nb_team?></p>
            </div>
            <div class="row justify-content-center">
                <p>Date du tournoi : <?=$date_start?></p>
            </div>
            <?if ($registered->num_rows() < $tournament->nb_team) {?>
                <form method="post" action=<?=base_url('tournoi/register_tournament')?>>
                    <div class="row justify-content-center border">
                        <input type="hidden" name="tournament_id" value="<?=$tournament->id?>">
                        <button class="btn btn-primary" type="submit">Inscrire votre equipe au tournoi</button>
                    </div>
                </form>
            <?} else {?>
                <div class="row justify-content-center">
                    <p>Tournoi complet</p>
                </div>
            <?}?>
        </div>
        <div class="col-lg-4 col-sm-4 align-self-center border ">
            <?if ($registered->num_rows() > 0) {?>
                <div class="row justify-content-center">
                    <h6>Equipe Inscrite :</h6>
                </div>
                <?foreach ($registered->result() as $register) {?>
                    <div class="row justify-content-center border">
                        <?foreach ($teams->result() as $team) {?>
                            <?if ($register->team_id == $team->id) {?>
                                <p><?=$team->name?></p>
                            <?}?>
                        <?}?>
                    </div>
                <?}?>
            <?} else {?>
                <div class="row justify-content-center">
                    <h6>Pas encore d'équipe incriste</h6>
                </div>
            <?}?>
        </div>
    </div>
    
    <?// Les matchs du tournoi
    if (!empty($matchs)) {?>
        <h2 class="text-center">Les Matchs</h2>
        <?if ($tournament->nb_team == 4) {?>
            <div class="d-flex justify-content-around border">
                <div class="col-lg-6 col-sm-4 border">
                <h3 class="text-center">Demi-finales</h3>
                    <?for ($i = 0; $i < 2; $i++) {
                        if($matchs[$i]['team_1'] != null && $matchs[$i]['team_2'] != null){
                            foreach ($teams->result() as $team) {
                                if ($matchs[$i]['team_1'] == $team->id) {?>
                                    <div class="row justify-content-center border">
                                        <p><?=$team->name?> vs
                                    <?}if ($matchs[$i]['team_2'] == $team->id) {?>
                                        <?=$team->name?></p>
                                    </div>
                                <?}
                            }
                        }
                    }?>
                </div>
                <div class="col-lg-6 col-sm-4 border align-self-center">
                    <h3 class="text-center">Finale</h3>
                    <?for ($i = 2; $i < $tournament->nb_team - 1 ;$i++) {?>
                        <?if ($matchs[$i]['team_1'] == null && $matchs[$i]['team_2'] == null) {?>
                            <div class="row justify-content-center border">
                                <p class="text-center">
                                TBD vs TBD
                                </p>
                            </div>
                        <?} else if($matchs[$i]['team_1'] != null && $matchs[$i]['team_2'] != null){
                            foreach ($teams->result() as $team) {
                                if ($matchs[$i]['team_1'] == $team->id) {?>
                                    <div class="row justify-content-center border">
                                        <p><?=$team->name?> vs
                                    <?}if ($matchs[$i]['team_2'] == $team->id) {?>
                                        <?=$team->name?></p>
                                    </div>
                                <?}
                            }
                        }    
                    }?>
                </div>
            </div>
        <?} else if ($tournament->nb_team == 8) {?>
            <div class="d-flex justify-content-around border">
                <div class="col-lg-4 col-sm-4 border">
                <h3 class="text-center">Quart de finales</h3>
                    <?for ($i = 0; $i < 4; $i++) {
                        if($matchs[$i]['team_1'] != null && $matchs[$i]['team_2'] != null){
                            foreach ($teams->result() as $team) {
                                if ($matchs[$i]['team_1'] == $team->id) {?>
                                    <div class="row justify-content-center border">
                                        <p><?=$team->name?> vs
                                    <?}if ($matcsh[$i]['team_2'] == $team->id) {?>
                                        <?=$team->name?></p>
                                    </div>
                                <?}
                            }
                        }
                    }?>
                </div>
                <div class="col-lg-4 col-sm-4 border align-self-center">
                    <h3 class="text-center">Demi-finales</h3>
                    <?for ($i = 4; $i < 6; $i++) {?>
                        <?if ($matchs[$i]['team_1'] == null && $matchs[$i]['team_2'] == null) {?>
                            <div class="row justify-content-center border">
                                <p class="text-center">
                                TBD vs TBD
                                </p>
                            </div>
                        <?} else if($matchs[$i]['team_1'] != null && $matchs[$i]['team_2'] != null){
                            foreach ($teams->result() as $team) {
                                if ($matchs[$i]['team_1'] == $team->id) {?>
                                    <div class="row justify-content-center border">
                                        <p><?=$team->name?> vs
                                    <?}if ($matchs[$i]['team_2'] == $team->id) {?>
                                        <?=$team->name?></p>
                                    </div>
                                <?}
                            }
                        }?>
                    <?}?>
                </div>
                <div class="col-lg-4 col-sm-4 border align-self-center">
                    <h3 class="text-center">Finale</h3>
                    <?for ($i = 6; $i < $tournament->nb_team - 1 ;$i++) {?>
                        <?if ($matchs[$i]['team_1'] == null && $matchs[$i]['team_2'] == null) {?>
                            <div class="row justify-content-center border">
                                <p class="text-center">
                                TBD vs TBD
                                </p>
                            </div>
                        <?} else if($matchs[$i]['team_1'] != null && $matchs[$i]['team_2'] != null){
                            foreach ($teams->result() as $team) {
                                if ($matchs[$i]['team_1'] == $team->id) {?>
                                    <div class="row justify-content-center border">
                                        <p><?=$team->name?> vs
                                    <?}if ($matchs[$i]['team_2'] == $team->id) {?>
                                        <?=$team->name?></p>
                                    </div>
                                <?}
                            }
                        }?>
                    <?}?>
                </div>
            </div>
        <?} else if ($tournament->nb_team == 16) {?>
            <div class="d-flex justify-content-around border">
                <div class="col-lg-3 col-sm-3 border">
                <h3 class="text-center">Huitièmes de finale</h3>
                    <?for ($i = 0; $i < 8; $i++) {
                        if($matchs[$i]['team_1'] != null && $matchs[$i]['team_2'] != null){
                            foreach ($teams->result() as $team) {
                                if ($matchs[$i]['team_1'] == $team->id) {?>
                                    <div class="row justify-content-center border">
                                        <p><?=$team->name?> vs
                                    <?}if ($matcsh[$i]['team_2'] == $team->id) {?>
                                        <?=$team->name?></p>
                                    </div>
                                <?}
                            }
                        }
                    }?>
                </div>
                <div class="col-lg-3 col-sm-3 border align-self-center">
                    <h3 class="text-center">Quart de finale</h3>
                    <?for ($i = 8; $i < 12;$i++) {?>
                        <?if ($matchs[$i]['team_1'] == null && $matchs[$i]['team_2'] == null) {?>
                            <div class="row justify-content-center border">
                                <p class="text-center">
                                TBD vs TBD
                                </p>
                            </div>
                        <?} else if($matchs[$i]['team_1'] != null && $matchs[$i]['team_2'] != null){
                            foreach ($teams->result() as $team) {
                                if ($matchs[$i]['team_1'] == $team->id) {?>
                                    <div class="row justify-content-center border">
                                        <p><?=$team->name?> vs
                                    <?}if ($matchs[$i]['team_2'] == $team->id) {?>
                                        <?=$team->name?></p>
                                    </div>
                                <?}
                            }
                        }?>
                    <?}?>
                </div>
                <div class="col-lg-3 col-sm-3 border align-self-center">
                    <h3 class="text-center">Demi-finales</h3>
                    <?for ($i = 12; $i < 14; $i++) {?>
                        <?if ($matchs[$i]['team_1'] == null && $matchs[$i]['team_2'] == null) {?>
                            <div class="row justify-content-center border">
                                <p class="text-center">
                                TBD vs TBD
                                </p>
                            </div>
                        <?} else if($matchs[$i]['team_1'] != null && $matchs[$i]['team_2'] != null){
                            foreach ($teams->result() as $team) {
                                if ($matchs[$i]['team_1'] == $team->id) {?>
                                    <div class="row justify-content-center border">
                                        <p><?=$team->name?> vs
                                    <?}if ($matchs[$i]['team_2'] == $team->id) {?>
                                        <?=$team->name?></p>
                                    </div>
                                <?}
                            }
                        }?>
                    <?}?>
                </div>
                <div class="col-lg-3 col-sm-3 border align-self-center">
                    <h3 class="text-center">Finale</h3>
                    <?for ($i = 14; $i < $tournament->nb_team - 1 ;$i++) {?>
                        <?if ($matchs[$i]['team_1'] == null && $matchs[$i]['team_2'] == null) {?>
                            <div class="row justify-content-center border">
                                <p class="text-center">
                                TBD vs TBD
                                </p>
                            </div>
                        <?} else if($matchs[$i]['team_1'] != null && $matchs[$i]['team_2'] != null){
                            foreach ($teams->result() as $team) {
                                if ($matchs[$i]['team_1'] == $team->id) {?>
                                    <div class="row justify-content-center border">
                                        <p><?=$team->name?> vs
                                    <?}if ($matchs[$i]['team_2'] == $team->id) {?>
                                        <?=$team->name?></p>
                                    </div>
                                <?}
                            }
                        }?>
                    <?}?>
                </div>
            </div>
        <?} else if ($tournament->nb_team == 32) {?>
            <div class="d-flex justify-content-around border">
                <div class="col-auto mr-auto border">
                <h3 class="text-center">Seizième de finale</h3>
                    <?for ($i = 0; $i < 16; $i++) {
                        if($matchs[$i]['team_1'] != null && $matchs[$i]['team_2'] != null){
                            foreach ($teams->result() as $team) {
                                if ($matchs[$i]['team_1'] == $team->id) {?>
                                    <div class="row justify-content-center border">
                                        <p><?=$team->name?> vs
                                    <?}if ($matcsh[$i]['team_2'] == $team->id) {?>
                                        <?=$team->name?></p>
                                    </div>
                                <?}
                            }
                        }
                    }?>
                </div>
                <div class="col-auto mr-auto border align-self-center">
                    <h3 class="text-center">Huitièmes de finale</h3>
                    <?for ($i = 16; $i <24; $i++) {?>
                        <?if ($matchs[$i]['team_1'] == null && $matchs[$i]['team_2'] == null) {?>
                            <div class="row justify-content-center border">
                                <p class="text-center">
                                TBD vs TBD
                                </p>
                            </div>
                        <?} else if($matchs[$i]['team_1'] != null && $matchs[$i]['team_2'] != null){
                            foreach ($teams->result() as $team) {
                                if ($matchs[$i]['team_1'] == $team->id) {?>
                                    <div class="row justify-content-center border">
                                        <p><?=$team->name?> vs
                                    <?}if ($matchs[$i]['team_2'] == $team->id) {?>
                                        <?=$team->name?></p>
                                    </div>
                                <?}
                            }
                        }?>
                    <?}?>
                </div>
                <div class="col-auto mr-auto border align-self-center">
                    <h3 class="text-center">Quart de finale</h3>
                    <?for ($i = 24; $i < 28; $i++) {?>
                        <?if ($matchs[$i]['team_1'] == null && $matchs[$i]['team_2'] == null) {?>
                            <div class="row justify-content-center border">
                                <p class="text-center">
                                TBD vs TBD
                                </p>
                            </div>
                        <?} else if($matchs[$i]['team_1'] != null && $matchs[$i]['team_2'] != null){
                            foreach ($teams->result() as $team) {
                                if ($matchs[$i]['team_1'] == $team->id) {?>
                                    <div class="row justify-content-center border">
                                        <p><?=$team->name?> vs
                                    <?}if ($matchs[$i]['team_2'] == $team->id) {?>
                                        <?=$team->name?></p>
                                    </div>
                                <?}
                            }
                        }?>
                    <?}?>
                </div>
                <div class="col-auto mr-auto border align-self-center">
                    <h3 class="text-center">Demi-finales</h3>
                    <?for ($i = 28; $i < 30; $i++) {?>
                        <?if ($matchs[$i]['team_1'] == null && $matchs[$i]['team_2'] == null) {?>
                            <div class="row justify-content-center border">
                                <p class="text-center">
                                TBD vs TBD
                                </p>
                            </div>
                        <?} else if($matchs[$i]['team_1'] != null && $matchs[$i]['team_2'] != null){
                            foreach ($teams->result() as $team) {
                                if ($matchs[$i]['team_1'] == $team->id) {?>
                                    <div class="row justify-content-center border">
                                        <p><?=$team->name?> vs
                                    <?}if ($matchs[$i]['team_2'] == $team->id) {?>
                                        <?=$team->name?></p>
                                    </div>
                                <?}
                            }
                        }?>
                    <?}?>
                </div>
                <div class="col-auto mr-auto border align-self-center">
                    <h3 class="text-center">Finale</h3>
                    <?for ($i = 30; $i < $tournament->nb_team - 1 ;$i++) {?>
                        <?if ($matchs[$i]['team_1'] == null && $matchs[$i]['team_2'] == null) {?>
                            <div class="row justify-content-center border">
                                <p class="text-center">
                                TBD vs TBD
                                </p>
                            </div>
                        <?} else if($matchs[$i]['team_1'] != null && $matchs[$i]['team_2'] != null){
                            foreach ($teams->result() as $team) {
                                if ($matchs[$i]['team_1'] == $team->id) {?>
                                    <div class="row justify-content-center border">
                                        <p><?=$team->name?> vs
                                    <?}if ($matchs[$i]['team_2'] == $team->id) {?>
                                        <?=$team->name?></p>
                                    </div>
                                <?}
                            }
                        }?>
                    <?}?>
                </div>
            </div>
        <?}
    }
}?>