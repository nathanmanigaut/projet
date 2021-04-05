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
    <?$date_start = date_create($tournoi->date_start);
      $date_start = $date_start->format('d/m/Y H\hi')?>
      <tr>
      
        <td><?=$date_start?></td>
        <td><a href="http://localhost/projet/tournoi/display/<?=$tournoi->id?>"><?=$tournoi->name?></a></td>
          <?foreach($games->result() as $jeu){?>
            <?if($jeu->id == $tournoi->jeux_id){?>
              <td><?=$jeu->name?></td>
            <?}?>

          <?}?>
          
        
        <td><?=$tournoi->nb_team?></td>
      </tr>
      </a>
      <?}?>    
  </tbody>
</table>