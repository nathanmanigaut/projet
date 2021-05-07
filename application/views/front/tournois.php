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
  <?foreach($tournaments->result() as $tournament){?>
      <tr>
      
        <td><?=$date_start?></td>
        <td><a href=<?=base_url('tournoi/display/')?><?=$tournament->id?>><?=$tournament->name?></a></td>
          <?foreach($games->result() as $jeu){?>
            <?if($jeu->id == $tournament->jeux_id){?>
              <td><?=$jeu->name?></td>
            <?}?>

          <?}?>
          
        
        <td><?=$tournament->nb_team?></td>
      </tr>
      </a>
      <?}?>    
  </tbody>
</table>