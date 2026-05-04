  <div class='container-fluid'>
    <div class="row pt-4">
      <div class="col-12 col-md-8 input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"> ยอดผลิตสุทธิ / ส่งคลังสินค้า </span>
        </div>
        <input id="fg_pl" type="text" class="form-control text-primary" readonly>
        <span class="input-group-text">พาเลท</span>
        <input id="fg_pk" type="text" class="form-control text-primary" readonly>
        <span class="input-group-text">ลัง</span>
      </div>

      <div class="col-12 col-md-4 input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">คิดเป็นลังได้</span>
        </div>
        <input id="fg_cal_pk" type="text" class="form-control text-primary" readonly>
        <span class="input-group-text">ลัง</span>
      </div>
    </div>
    <?php
    if ($usrMODE == "ADM" || $usrMODE == "PIS") {
      $show_BOM = "block";
      echo " <div><span class='text-primary h5'>* Admin แสดงค่า BOM</span> </div>";
    } else {
      $show_BOM = "none";
      echo " <div><span class='text-danger h5'>* ปิดการแสดงค่า BOM</span> </div>";
    }
    ?>

    <?php



    //"Treated Waster","ลิตร"
    //$MAT = array("Syrup", "CO2", "ขวด/กระป๋อง","ฝา","ฉลาก","ถาดกระดาษ","บาร์โค๊ด x12","บาร์โค๊ด x24","ฟิล์มหุ้มแพ็ค x12","ฟิล์มหุ้มแพ็ค x24","แผ่นรอง","ฟิล์มยืดพันพาเลท");
    $MATS_ENG = array('syrup', 'co2', 'preform', 'bt', 'cap', 'label', 'glue_label', 'glue_tray', 'tray', 'barcode_pk', 'barcode_pl', 'film_step1', 'film_step2', 'sheet_top', 'sheet', 'wrap');
    $MAT = array("Syrup", "CO2", "Preform", "ขวด/กระป๋อง", "ฝา", "ฉลาก", "กาวฉลาก", "กาวถาด", "ถาดกระดาษ", "บาร์โค๊ดแพ็ค", "บาร์โค๊ดพาเลท", "ฟิล์มหุ้มแพ็ค step1 Pack6 หรือ Pack12", "ฟิล์มหุ้มแพ็ค step2 Pack24", "แผ่นรอง บน", "แผ่นรอง", "ฟิล์มยืดพันพาเลท"); //, "Treated Water"
    $UNIT = array("ลิตร", "กก.", "ขวด", "ขวด", "ฝา", "ชิ้น", "กก.", "กก.", "แผ่น", "ชิ้น", "ชิ้น", "กก.", "กก.", "แผ่น", "แผ่น", "กก."); //, "ลิตร"

    for ($i = 0; $i < count($MAT); $i++) {
      if ($i % 2 == 0) $bgcolor = "#FFF";
      else $bgcolor = "#C4FAFF";

      $row = $i + 1;
      //$BGCOLOR = "rgba(119, 238, 104, 0.5)";

      $BGCOLOR = "#acf23cba";
      // if (($row % 2) == 0) {
      //   $BGCOLOR = "147,211,219,0.5";
      //   //$BGCOLOR = "147,211,219,0.5";
      // } else {
      //   $BGCOLOR = "202,215,113,0.5";
      //   //$BGCOLOR = "147,211,219,0.5";
      // }
      $show = "block";


      echo " <div class='card mt-1 mb-3' id='bom_" . ($i + 1) . "' style='font-size: 1rem;background-color:$BGCOLOR;color:black;display:block;'>
      
          <div class='card-header'>
              <div id='MATname_" . ($i + 1) . "' class='col-12 text-left ml-1'  style='font-size: 1.2rem;'>" . $MAT[$i] . "</div>
          </div>
          <div class='card-body row'>

            <div class='col-12 col-md-4 col-lg-2  input-group' id='div_" . $row . "_bom' style='display:$show_BOM;'>
              <span>Require Qty (BOM)</span><br>
              <div class='input-group mb-3'>
                <input type='text' class='form-control text-primary'  id='mat_" . $row . "_bom' type='number' value='0' disabled '>
                <div class='input-group-append'>
                  <span class='input-group-text'>" . $UNIT[$i] . "</span>
                </div>
              </div>
            </div>

            <div class='col-12 col-md-4 col-lg-2  input-group' id='div_" . $row . "_fwd' style='display:$show'>
              <span>ยอดยกมา</span><br>
              <div class='input-group mb-3'>
                <input type='text' class='form-control'  id='mat_" . $row . "_fwd' type='number' style='background-color:#BCF8F6;color:black;'; value='0'>
                <div class='input-group-append'>
                  <span class='input-group-text'>" . $UNIT[$i] . "</span>
                </div>
              </div>
            </div>

            <div class='col-12 col-md-4 col-lg-2  input-group' id='div_" . $row . "_take' style='display:$show'>
              <span>ยอกเบิก</span><br>
              <div class='input-group mb-3'>
                <input type='text' class='form-control'  id='mat_" . $row . "_take'  ype='number' style='background-color:#BCF8F6;color:black;'; value='0'>
                <div class='input-group-append'>
                  <span class='input-group-text'>" . $UNIT[$i] . "</span>
                </div>
              </div>
            </div>

            <div class='col-12 col-md-4 col-lg-2  input-group' id='div_" . $row . "_use' style='display:$show'>
              <span><span id='need_" . $row . "' class='small'>🔴</span> ยอดใช้จริง</span><br>
              <div class='input-group mb-3'>
                <input type='text' class='form-control'  id='mat_" . $row . "_use' type='number' style='background-color:white;color:blue;'; value='0' >
                <div class='input-group-append'>
                  <span class='input-group-text'>" . $UNIT[$i] . "</span>
                </div>
              </div>
            </div>

            <div class='col-12 col-md-4 col-lg-2  input-group' id='div_" . $row . "_bal' style='display:$show'>
              <span>คงเหลือ</span><br>
              <div class='input-group mb-3'>
                <input type='text' class='form-control'  id='mat_" . $row . "_bal'  type='number' value='0' disabled  style='color:#0D6EFD;'>
                <div class='input-group-append'>
                  <span class='input-group-text'>" . $UNIT[$i] . "</span>
                </div>
              </div>
            </div>

            <div class='col-12 col-md-4 col-lg-2  input-group' id='div_" . $row . "_diff' style='display:$show'>
              <span>ผลต่าง/สูญเสีย</span><br>
              <div class='input-group mb-3'>
                <input type='text' class='form-control'  id='mat_" . $row . "_diff'  type='number' value='0' disabled  style='color:#0D6EFD;'>
                <div class='input-group-append'>
                  <span class='input-group-text'>" . $UNIT[$i] . "</span>
                </div>
              </div>
            
              <div class='input-group mb-3'>
                <input class='form-control' id='mat_" . $row . "_pc_diff' type='number' value='0' disabled  style='color:#0D6EFD;'>
                <div class='input-group-append'>
                  <span class='input-group-text'>%</span>
                </div>
              </div>
            </div>

        </div>
    </div>";
    }
    ?>
  </div>