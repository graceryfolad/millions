<?php
        if (isset($error)) {
            echo "<div class=\"fp\">$error</div>";
        } elseif (isset($myerror)) {
            foreach ($myerror as $value) {
                echo "<div class=\"fp\">$value</div>";
            }
        }



        echo form_open('/Process/DoRegister', array('class' => ""));
        ?>

        <div class="input-control text full-size">
            <label>Full Name</label>
            
            <input type="text" name="name" class="form-control" placeholder="Full name" required="required" id="fullname" readonly value="<?php if(isset($matrix) && is_array($matrix)){echo $matrix['name'];}?>"/>
        </div>
        <br/>
        <br/>
        <div class="input-control text full-size">
            <input type="email" name="email" class="form-control" placeholder="Email Address" required="required" id="email" readonly value="<?php if(isset($matrix) && is_array($matrix)){echo $matrix['email'];}?>"/>
        </div>
        <br/>
        <br/>
        <div class="input-control text full-size">
            <input type="text" name="phone" class="form-control" placeholder="Phone Number" required="required" id="phone" readonly value="<?php if(isset($matrix) && is_array($matrix)){echo $matrix['phone'];}?>"/>
        </div>
        <br/>
        <br/>
        <div class="input-control select full-size">
            <select name="pack" class="form-control">
                <?php
                if (isset($packs)) {
                    foreach ($packs as $value) {
                        echo "<option value=\"{$value['pack_id']}\">{$value['pack_name']}</option>";
                    }
                }
                ?>
            </select>
        </div>
        <br/>
        <br/>
        <div class="input-control password full-size">
            <input type="password" name="password" class="form-control" placeholder="Password" required="required"/>
        </div>
        <br/>
        <br/>
        <div class="input-control password full-size">
            <input type="password" name="password2" class="form-control" placeholder="Retype password" required="required"/>
        </div>
        <br/>
        <br/>
        <input type="hidden" name="username" value="<?php if(isset($matrix) && is_array($matrix)){echo $matrix['username'];}?>"/>

        <input type="submit" class="button primary" value="Sign Up" name="submit"/>

        <?php
        echo anchor('Home/Login', 'Already a Vendor', 'title="Login to Vendor Area"');
        ?>

        </form>