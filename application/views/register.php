<div id="reg_div">
   <p align="center"> 
      Регистрация нового пользователя
   </p>
   <form action="/msp/modules/user.php" method="POST">
      <table>
         <tr>
            <td>
               Логин* :
            </td>
            <td>
               <input type="text" class="register" name="reg_login" value="" size="25" maxlength="30" />
            </td>
         </tr>
         <tr>
            <td>Пароль* :</td>
            <td><input type="password" class="register" name="reg_pass" value="" size="25" maxlength="30" /></td>
         </tr>
         <tr>
            <td>Повторите пароль* :</td>
            <td><input type="password" class="register" name="reg_pass2" value="" size="25" maxlength="30" /></td>
 <!--

         </tr>

         <tr>
            <td>Как Вас зовут? :</td>
            <td><input type="text" name="regName" value="" size="25" maxlength="20" /></td>
         </tr>
         <tr>
            <td>Ваша фамилия :</td>
            <td><input type="text" name="regSurname" value="" size="25" maxlength="30" /></td>
         </tr>
         <tr>
            <td>Ваш возраст :</td>
            <td><input type="text" name="regAge" value="" size="25" maxlength="2" /></td>
         </tr>
-->

         <tr>
            <td></td>
            <td>
               <input type="reset" class="sbmt" name="reset" value="Очистить" />
               <input type="submit" class="sbmt" name="ok" value="Готово" />
            </td>
         </tr>
      </table>
   </form>
</div>