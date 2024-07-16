import React, { useRef, useEffect } from 'react';


const CircleCanvas = () => {
    const canvasRef = useRef(null);
  
    useEffect(() => {
      const canvas = canvasRef.current;
      const ctx = canvas.getContext('2d');
  
      const animateCircle = () => {
        requestAnimationFrame(animateCircle);
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        
  
        // Круги
        let Circl1 = (Math.sin(Date.now() * 0.002) * 8) + 180;
  
        ctx.beginPath();
        ctx.arc(450, Circl1, 50, 0, 2 * Math.PI);
        

        const gradientCircle1 = ctx.createLinearGradient(450, 180, 450, 200);
        gradientCircle1.addColorStop(0, "#4DDC46");       
        gradientCircle1.addColorStop(1, "#9EF29A");
        ctx.fillStyle = gradientCircle1;
        ctx.shadowColor = "#CFCFCF"
        ctx.shadowBlur = 20;
        ctx.shadowOffsetX = -10;
        ctx.shadowOffsetY = -10;
        ctx.fill();

        let Circl2 = (Math.sin(Date.now() * 0.0015) * 8) + 500;
  
        ctx.beginPath();
        ctx.arc(1050, Circl2, 50, 0, 2 * Math.PI);


        const gradientCircle2 = ctx.createLinearGradient(500, 1050, 450, 995);
        gradientCircle2.addColorStop(0, "#4DDC46");       
        gradientCircle2.addColorStop(1, "#9EF29A");
        ctx.fillStyle = gradientCircle2;
        ctx.shadowColor = "#bbbbbb"
        ctx.shadowBlur = 20;
        ctx.shadowOffsetX = 15;
        ctx.shadowOffsetY = 15;
        ctx.fill();

        //Квадрат
        ctx.translate(300, 300);
        const cubeSize = 100;
        const cornerRadius = 20;

        
        let Cube1 = (Math.sin(Date.now() * 0.00095) * 20) + 50;
        ctx.rotate((45 * Math.PI) / 180);
        ctx.beginPath();
        ctx.moveTo(150 + cornerRadius, Cube1); // начинаем от закругленного верхнего левого угла
        ctx.lineTo(150 + cubeSize - cornerRadius, Cube1); // добавляем верхнюю сторону
        ctx.arcTo(150 + cubeSize, Cube1, 150 + cubeSize, Cube1 + cornerRadius, cornerRadius);
        ctx.lineTo(150 + cubeSize, Cube1 + cubeSize - cornerRadius); // добавляем правую сторону
        ctx.arcTo(150 + cubeSize, Cube1 + cubeSize, 150 + cubeSize - cornerRadius, Cube1 + cubeSize, cornerRadius);

        ctx.lineTo(150 + cornerRadius, Cube1 + cubeSize); // добавляем нижнюю сторону
        ctx.arcTo(150, Cube1 + cubeSize, 150, Cube1 + cubeSize - cornerRadius, cornerRadius);

        ctx.lineTo(150, Cube1 + cornerRadius); // добавляем левую сторону и закрываем путь
        ctx.arcTo(150, Cube1, 150 + cornerRadius, Cube1, cornerRadius);
        ctx.closePath();

        

        const gradientCube1 = ctx.createLinearGradient(300, 300, 30, 30);
        gradientCube1.addColorStop(0, "#FFD451");       
        gradientCube1.addColorStop(1, "#FFE8A2");
        ctx.fillStyle = gradientCube1;
        ctx.fill();
        ctx.restore();

        ctx.translate(450, -800);
        let Cube2 = (Math.sin(Date.now() * 0.001) * 20) + 50;
        ctx.rotate((45 * Math.PI) / 180);
        ctx.beginPath();
        ctx.moveTo(150 + cornerRadius, Cube2); // начинаем от закругленного верхнего левого угла
        ctx.lineTo(150 + cubeSize - cornerRadius, Cube2); // добавляем верхнюю сторону
        ctx.arcTo(150 + cubeSize, Cube2, 150 + cubeSize, Cube2 + cornerRadius, cornerRadius);
        ctx.lineTo(150 + cubeSize, Cube2 + cubeSize - cornerRadius); // добавляем правую сторону
        ctx.arcTo(150 + cubeSize, Cube2 + cubeSize, 150 + cubeSize - cornerRadius, Cube2 + cubeSize, cornerRadius);

        ctx.lineTo(150 + cornerRadius, Cube2 + cubeSize); // добавляем нижнюю сторону
        ctx.arcTo(150, Cube2 + cubeSize, 150, Cube2 + cubeSize - cornerRadius, cornerRadius);

        ctx.lineTo(150, Cube2 + cornerRadius); // добавляем левую сторону и закрываем путь
        ctx.arcTo(150, Cube2, 150 + cornerRadius, Cube2, cornerRadius);
        ctx.closePath();

        

        const gradientCube2 = ctx.createLinearGradient(300, 300, 30, 30);
        gradientCube2.addColorStop(0, "#FFD451");       
        gradientCube2.addColorStop(1, "#FFE8A2");
        ctx.fillStyle = gradientCube2;
        ctx.fill();
        ctx.restore();
        
        //Треугольник

        // let Triangle1 = (Math.sin(Date.now() * 0.002) * 8) + 180;
        // const triangleHeight = 100;
        // const triangleBase = 160;
        

        
        // ctx.beginPath();
        // ctx.moveTo(triangleBase / 2, Triangle1); // начинаем от верхней точки треугольника

        // // Рисуем линии треугольника с закругленными углами
        // ctx.lineTo(triangleBase - cornerRadius, Triangle1 + triangleHeight); // добавляем правую сторону
        // ctx.arcTo(triangleBase, Triangle1 + triangleHeight, triangleBase, Triangle1 + triangleHeight - cornerRadius, cornerRadius);
              
        // ctx.lineTo(cornerRadius, Triangle1 + triangleHeight); // добавляем левую сторону
        // ctx.arcTo(0, Triangle1 + triangleHeight, 0, Triangle1 + triangleHeight - cornerRadius, cornerRadius);
              
        // ctx.closePath();
              
        // const gradientTriangle = ctx.createLinearGradient(50, 30, 80, 50);
        // gradientTriangle.addColorStop(0, "#FFD451");       
        // gradientTriangle.addColorStop(1, "#FFE8A2");
        // ctx.fillStyle = gradientTriangle;
        // ctx.fill();
              
        // ctx.restore(); 

      };
  
      animateCircle();
    }, []);
  
    return (
      <canvas
        ref={canvasRef}
        className="circle-canvas block fixed -z-10 "
      />
    );
  }
  
  export default CircleCanvas;