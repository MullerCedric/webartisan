<form action="#" method="get">
  <div class="c-job__field-group">
    <div class="c-job__field-title">Type d'emploi</div>
    <div>
      <div>
        <input type="checkbox" id="type_work" name="type_work">
        <label for="type_work" class="c-job__label">Travail</label>
      </div>
      <div>
        <input type="checkbox" id="type_internship" name="type_internship">
        <label for="type_internship" class="c-job__label">Stage</label>
      </div>
    </div>
  </div>
  <div class="c-job__field-group">
    <div class="c-job__field-title">Taux horaire par semaine</div>
    <div>
      Entre <label class="sr-only" for="hourly_rate_min">minimum</label>
      <input type="number" min="4" max="38" value="4"
             id="hourly_rate_min" name="hourly_rate_min" class="c-job__number"> et
      <label class="sr-only" for="hourly_rate_max">maximum</label>
      <input type="number" min="4" max="38" value="38"
             id="hourly_rate_max" name="hourly_rate_max" class="c-job__number"> H
    </div>
  </div>
  <div class="c-job__field-group">
    <label for="skills" class="c-job__label c-job__field-title">Compétences</label>
    <div class="c-job__bar">
      <input type="text" id="skills" name="skills">
      <button type="submit" class="c-job__button c-job__button--small">Ajouter</button>
    </div>
  </div>
  <div class="c-job__field-group">
    <div class="c-job__field-title">Type de société</div>
    <div>
      <input type="checkbox" id="type_startup" name="company_type[]">
      <label for="type_startup" class="c-job__label">Startup</label>
    </div>
    <div>
      <input type="checkbox" id="type_agency" name="company_type[]">
      <label for="type_agency" class="c-job__label">Agence</label>
    </div>
  </div>
  <div class="c-job__field-group">
    <button type="submit" class="c-job__button">Filtrer</button>
  </div>
</form>
