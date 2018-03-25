// Dropdown Menu
var vm_dropdown = document.querySelectorAll('.vm_dropdown');
var vm_dropdownArray = Array.prototype.slice.call(vm_dropdown,0);
vm_dropdownArray.forEach(function(el){
    var button = el.querySelector('a[data-toggle="vm_dropdown"]'),
        menu = el.querySelector('.vm_dropdown-menu'),
        arrow = button.querySelector('i.icon-arrow');

    button.onclick = function(event) {
        if(!menu.hasClass('show')) {
            menu.classList.add('show');
            menu.classList.remove('hide');
            arrow.classList.add('open');
            arrow.classList.remove('close');
            event.preventDefault();
        }
        else {
            menu.classList.remove('show');
            menu.classList.add('hide');
            arrow.classList.remove('open');
            arrow.classList.add('close');
            event.preventDefault();
        }
    };
});

Element.prototype.hasClass = function(className) {
    return this.className && new RegExp("(^|\\s)" + className + "(\\s|$)").test(this.className);
};