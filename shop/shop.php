<center> <h3>Modify Account</h3> </center>
<hr>
<form action="modify.php" method="post">
<div class=" filter-bar align-items-center">
<h4>Number of customers per 30 minute slot</h4>
<hr>
    <div>
		<input type="number" style="width:100%;" class="form-control" id="num" name="num" placeholder="No. of people per 30 min slot" onfocus="this.placeholder = ''" onblur="this.placeholder = 'No. of people per 30 min slot'" min="1" max="20" required>
    </div>
    <div class="text-center">
        <button style="margin:5px;" type="submit" id="slot_no" name="slot_no" class="button button-login">Modify No. of People per Slot</button>
    </div>  
</div>
 
</form>
<form action="modify.php" method="post">

<div class="col-md-12 filter-bar align-items-center">
<h4>Select Categories</h4>
<hr>
              	<div class="creat_account">
                <input type="checkbox" id="f-option1" name="cuisine[]" value="Medical">
                <label for="f-option1">Medical</label>
                </div>
                <div class="creat_account">
                <input type="checkbox" id="f-option2" name="cuisine[]" value="Fruits & Vegetables">
                <label for="f-option2">Fruits & Vegetables</label>
                </div>
                <div class="creat_account">
                <input type="checkbox" id="f-option3" name="cuisine[]" value="Household">
                <label for="f-option3">Household</label>
                </div>
                <div class="creat_account">
                <input type="checkbox" id="f-option4" name="cuisine[]" value="Packaged Food">
                <label for="f-option4">Packaged Food</label>
                </div>
                <div class="creat_account">
                <input type="checkbox" id="f-option5" name="cuisine[]" value="Eggs & Meat">
                <label for="f-option5">Eggs & Meat</label>
                </div>
                <div class="creat_account">
                <input type="checkbox" id="f-option6" name="cuisine[]" value="Beauty & Hygiene">
                <label for="f-option6">Beauty & Hygiene</label>
                </div>
                <div class="creat_account">
                <input type="checkbox" id="f-option7" name="cuisine[]" value="Others">
                <label for="f-option7">Others</label>
                </div>
              
    <div class="text-center">
        <button style="margin:5px;" type="submit" id="modify_category" name="modify_category" class="button button-login">Modify Categories</button>
    </div>
</form>


