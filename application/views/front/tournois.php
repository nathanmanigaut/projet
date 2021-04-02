<? 
$tournois = $this->tournoi->orderbys('date_start','ASC');
$games = $this->game->gets();
?>

<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">Date du tournoi</th>
      <th scope="col">Nom du tournoi</th>
      <th scope="col">Jeu du tournoi</th>
      <th scope="col">Nombre de participants</th>
    </tr>
  </thead>
  <tbody>
  <?foreach($tournois->result() as $tournoi){?>
      <tr>
        <td><?=$tournoi->date_start?></td>
        <td><a href="http://localhost/projet/tournoi/display/<?=$tournoi->id?>"><?=$tournoi->name?></a></td>
          <?foreach($games->result() as $jeu){?>
            <?if($jeu->id == $tournoi->jeux_id){?>
              <td><?=$jeu->name?></td>
            <?}?>

          <?}?>
          
        
        <td><?=$tournoi->max_team?></td>
      </tr>
      </a>
      <?}?>    
  </tbody>
</table>