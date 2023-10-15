	function animateBanner() {
		animate0();
	}
	function animate0() {
		document.getElementById( "banner_01" ).style.visibility = "hidden";
		document.getElementById( "banner_02" ).style.visibility = "hidden";
		window.setTimeout( "animate1();", 1000 );
	}
	function animate1() {
		document.getElementById( "banner_01" ).style.visibility = "visible";
		window.setTimeout( "animate2();", 1000 );
	}
	function animate2() {
		document.getElementById( "banner_02" ).style.visibility = "visible";
		window.setTimeout( "animate3();", 1000 );
	}
	function animate3() {
		document.getElementById( "banner_02" ).style.visibility = "hidden";
		window.setTimeout( "animate4();", 200 );
	}
	function animate4() {
		document.getElementById( "banner_02" ).style.visibility = "visible";
		window.setTimeout( "animate5();", 170 );
	}
	function animate5() {
		document.getElementById( "banner_02" ).style.visibility = "hidden";
		window.setTimeout( "animate6();", 170 );
	}
	function animate6() {
		document.getElementById( "banner_02" ).style.visibility = "visible";
	}
	function selectMenuContainer( menuContainerId ) {
		document.getElementById( menuContainerId ).className = "menuContainerSelected";
	}
	function selectSubMenuContainer( subMenuContainerId ) {
		document.getElementById( subMenuContainerId ).className = "subMenuContainerSelected";
	}
