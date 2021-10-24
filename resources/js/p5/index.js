// export const sketch = function (p5) {
//   let xoff = 0.0;
//   let x2off = 10000;
//   let yoff= 0.0;
//   let start = 0;
//   let inc = 0.001;
//   let colors = ['#01E08F','#FB923C','#22D3EE','#F43F5E', '#FACC15']
// 	p5.setup = () => {
    // let canvasContainer = document.getElementById('canvasContainer');
    // let canvas = p5.createCanvas(canvasContainer.offsetWidth, canvasContainer.offsetHeight);
    // canvas.parent('canvasContainer');
//     p5.stroke('#01E08F')
//     p5.frameRate(24)
//   }
//   p5.draw = _ => {
// 	// p5.background('#05386B')
// 	p5.strokeWeight(10)
// 	p5.noFill()
	
// 	colors.map((color, index) => {
// 		p5.push()
// 		p5.stroke(color);
// 		yoff = start + (index * 100000);
// 		p5.beginShape()
// 		for(let x = 0; x < p5.width; x++) {
// 			let y = p5.map(p5.noise(yoff),0,1,0,p5.height);
// 			p5.vertex(x,y);
// 			yoff += inc;
// 		}
// 		p5.endShape()
// 		p5.pop()
// 	})
// 	start += inc * 2;

//     // xoff = xoff + 0.01;
//     // x2off = x2off + 0.01;
//     // p5.push()
//     // p5.stroke('#01E08F')
//     // p5.line(n, 0, n, p5.height);
//     // p5.pop()
//     // p5.push()
//     // p5.stroke('#05386B')
//     // p5.line(n2, 0, n2, p5.height);
//     // p5.pop()
//   }
// }

export const sketch = function(p5) {
	let centerX = 0.0, centerY = 0.0;
	
	let radius = 45, rotAngle = -90;
	let accelX = 0.0, accelY = 0.0;
	let deltaX = 0.0, deltaY = 0.0;
	let springing = 0.0009, damping = 0.98;
	
	//corner nodes
	let nodes = 5;
	
	//zero fill arrays
	let nodeStartX = [];
	let nodeStartY = [];
	let nodeX = [];
	let nodeY = [];
	let angle = [];
	let frequency = [];
	
	// soft-body dynamics
	let organicConstant = 1.0;
	
	p5.setup = () => {
		let canvasContainer = document.getElementById('canvasContainer');
		let canvas = p5.createCanvas(canvasContainer.offsetWidth, canvasContainer.offsetHeight);
		canvas.parent('canvasContainer')
		//center shape in window
		centerX = p5.width / 2;
		centerY = p5.height / 2;
		
		//initialize arrays to 0
		for (let i = 0; i < nodes; i++){
		  nodeStartX[i] = 0;
		  nodeStartY[i] = 0;
		  nodeY[i] = 0;
		  nodeY[i] = 0;
		  angle[i] = 0;
		}
		
		// iniitalize frequencies for corner nodes
		for (let i = 0; i < nodes; i++){
		  frequency[i] = p5.random(5, 12);
		}
		
		p5.noStroke();
		p5.frameRate(30);
	}
	p5.draw = () => {
		//fade background
		p5.fill(5, 56, 107, 100);
		// p5.fill(0,100)
		p5.rect(0, 0, p5.width, p5.height);
		drawShape();
		moveShape();
	}
	function drawShape() {
	  //  calculate node  starting locations
	  for (let i = 0; i < nodes; i++){
	    nodeStartX[i] = centerX + p5.cos(p5.radians(rotAngle)) * radius;
	    nodeStartY[i] = centerY + p5.sin(p5.radians(rotAngle)) * radius;
	    rotAngle += 360.0 / nodes;
	  }
	
	  // draw polygon
	  p5.curveTightness(organicConstant);
	  p5.fill('#01E08F');
	  p5.beginShape();
	  for (let i = 0; i < nodes; i++){
	    p5.curveVertex(nodeX[i], nodeY[i]);
	  }
	  for (let i = 0; i < nodes-1; i++){
	    p5.curveVertex(nodeX[i], nodeY[i]);
	  }
	  p5.endShape(p5.CLOSE);
	}
	
	function moveShape() {
	  //move center point
	  deltaX = p5.mouseX - centerX;
	  deltaY = p5.mouseY - centerY;
	
	  // create springing effect
	  deltaX *= springing;
	  deltaY *= springing;
	  accelX += deltaX;
	  accelY += deltaY;
	
	  // move predator's center
	  centerX += accelX;
	  centerY += accelY;
	
	  // slow down springing
	  accelX *= damping;
	  accelY *= damping;
	
	  // change curve tightness
	  organicConstant = 1 - ((p5.abs(accelX) + p5.abs(accelY)) * 0.1);
	
	  //move nodes
	  for (let i = 0; i < nodes; i++){
	    nodeX[i] = nodeStartX[i] + p5.sin(p5.radians(angle[i])) * (accelX * 2);
	    nodeY[i] = nodeStartY[i] + p5.sin(p5.radians(angle[i])) * (accelY * 2);
	    angle[i] += frequency[i];
	  }
	}
}




// function setup() {
//   createCanvas(710, 400);


// }

// function draw() {
  //fade background
  
// }

