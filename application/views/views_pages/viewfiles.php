<div class="row">
  <table class="table table-condensed">
    <thead>
      <tr>
        <th>File Description</th>
        <th>Live Preview</th>
      </tr>
      <tbody>
        <tr>
          <td>Identity/Passport</td>
          <td> <a href="<?php echo base_url().'profiles/'.$row->scanned_id; ?>" target="_blank">Preview file</a></td>
        </tr>
        <tr>
          <td>Degree Certificate</td>
          <td><a href="<?php echo base_url().'profiles/'.$row->degree_copy; ?>" target="_blank">Preview file</a></td>
        </tr>
        <?php if (!empty($row->motivation_letter) && strlen($row->motivation_letter)>4) {
          ?>
          <tr>
            <td>Autobiographical Essay</td>
            <td><a href="<?php echo base_url().'profiles/'.$row->motivation_letter; ?>" target="_blank">Preview file</a></td>
          </tr>
          <?php
        } ?>
        <?php if (!empty($row->birth_certificate && strlen($row->birth_certificate)>4)) {
          ?>
          <tr>
            <td>Certificate of birth</td>
            <td><a href="<?php echo base_url().'profiles/'.$row->birth_certificate; ?>" target="_blank">Preview file</a></td>
          </tr>
          <?php
        } ?>
        <tr>
          <td>Recommendation letter</td>
          <td><a href="<?php echo base_url().'profiles/'.$row->recomm_letter; ?>" target="_blank">Preview file</a></td>
        </tr>
        <tr>
          <td>Academic transcript/marks reports</td>
          <td><a href="<?php echo base_url().'profiles/'.$row->transcript; ?>" target="_blank">Preview file</a></td>
        </tr>
        <tr>
          <td>Statement of faith</td>
          <td><a href="<?php echo base_url().'profiles/'.$row->statement_faith; ?>" target="_blank">Preview file</a></td>
        </tr>
      </tbody>
    </thead>
  </table>
</div>
