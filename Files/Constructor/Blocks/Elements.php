<div class="NoSelect Elements tabs">
  <ul class='atabs'>
    <li><a href="#tabs-1">Элементы</a></li>
    <li><a href="#tabs-2">CSS</a></li>
  </ul>
    <div class="dtabs" id="tabs-1">
        <div class="ElemDrag drag" data-elem="
          <div class='YesSelect' style='background:#0ff; width: 200px; height: 100px;' class='drop'>

          </div>">
          Div1
        </div>
        <div class="ElemDrag drag" data-elem="
          <div class='YesSelect' style='background:#f0f; width: 50px; height: 50px;' class='drop'>

          </div>">
          Div2
        </div>
    </div>
    <div class="dtabs" id="tabs-2">
      <button class="deletebtn" type="button" name="button">Удалить элемент</button>
      <label for="id_num">Класс или ИД</label>
      <select name="id_num" id="id_num">
        <option class="optionselect" disabled selected>Выбирете класс или ИД</option>
      </select>
      <label>Или создайте новый</label>
      <input class="clearinput classoridinput" type="text" name="" value="">
      <button class="classoridbtn" type="button" name="button">Добавить</button>
      <label for="salutation">Свойства</label>
      <select class="changestyle disabledselect" disabled name="salutation" id="salutation">
        <option class="optionselect" disabled selected>Выбирете свойство</option>
        <option>width</option>
        <option>height</option>
        <option>padding</option>
        <option>margin</option>
        <option>background-color</option>
        <option>display</option>
        <option>flex-direction</option>
        <option>justify-content</option>
        <option>align-items</option>
        <option>color</option>
        <option>font-size</option>
      </select>
      <label>Значение</label>
      <input disabled class="clearinput disabledselect styleinput" type="text" name="" value="">
      <button disabled class="disabledselect stylebtn" type="button" name="button">Приминить</button>
    </div>
</div>

<div class="NoSelect showElems">
</div>

<div class="NoSelect SafeFile">
</div>
