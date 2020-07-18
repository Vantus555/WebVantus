class Styles{
  constructor(){
    this.stylenames = new Object();
  }
  AddStyleName(name){
    this.stylenames[name] = new StyleName(name);
  }
  AddStyle(name, style, value){
    if(!this.stylenames[name])
      this.AddStyleName(name);
    this.stylenames[name].AddStyle(style, value);
  }
  GetAllStylesName(name){
    if(this.stylenames[name])
      return this.stylenames[name].GetAllStyles();
  }
  GetStyleName(name, style){
    let styles = this.GetAllStylesName(name);
    if(styles){
      if(styles[style])
        return styles[style];
    }
    return false;
  }
}

class StyleName{
    constructor(name){
      this.styles = new Object();
      this.name = name;
    }
    AddStyle(style, value){
      this.styles[style] = value;
    }
    ReturnStyle(style){
      return this.styles[style];
    }
    Size(){
      return this.styles.length;
    }
    GetAllStyles(){
      return this.styles;
    }
  }
