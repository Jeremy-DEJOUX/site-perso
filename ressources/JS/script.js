var me = document.getElementById('me');
var about = document.getElementById('about');

about.addEventListener('click', function(){
  me.className = me.className !== 'show' ? 'show' : 'hide';
  if (me.className === 'show') {
    me.style.display = 'block';
    window.setTimeout(function(){
      me.style.opacity = 1;
      me.style.transform = 'scale(1)';
    },0);
  }
  if (me.className === 'hide') {
    me.style.opacity = 0;
    me.style.transform = 'scale(0)';
    window.setTimeout(function(){
      me.style.display = 'none';
    },700); // timed to match animation-duration
  }
 
});