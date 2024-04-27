#include "stm32f10x.h"
#include "stm32f10x_gpio.h"
//#include "stm32f10x_exti.h"
#include "misc.h"
#include "lcd.h"
#include <stdio.h>
//#include "STM32vldiscovery.h"
#include <stm32f10x_adc.h>
#include "stm32f10x_dma.h"
#include "stm32f10x_adc.h"
#include "stm32f10x_tim.h"
#include "stm32f10x_pwr.h"
uint16_t adc_val;
uint16_t adc_val_;
float Accel;
float volt;
char lcd_buff[16];
int Mode = 1;
int start = 0;
int select = 0;
int direct = 1;
/*************************Timer Overflow**************************/
volatile uint32_t Count;
volatile uint32_t Count_PWM;
volatile uint32_t Duty=70;
volatile uint32_t speed=0;
volatile uint32_t Count_speed=30;11
unsigned int Step[7][6] = {{0,0,0,0,0,0},
{1,0,0,0,0,1},
{0,0,1,0,0,1},
{0,1,1,0,0,0},
{0,1,0,0,1,0},
{0,0,0,1,1,0},
{1,0,0,1,0,0}};
unsigned int step = 0;
/******************************Variable ADC*****************************/
#define ADC1_DR_Address ((uint32_t)0x4001244C)
#define ADC_NUMCHANS 2
volatile unsigned short ADCValues[ADC_NUMCHANS];
/**********************************Delay********************************/
void Delay(volatile uint32_t ms)
{
volatile uint16_t i,j;
for(i=0;i<ms;i++)
for(j=0;j<3442;j++);
}
/****************************GPIO_Timer******************************/
void GPIO_Timer()
{
/***********Setup Interrupt Timer********************/
TIM_TimeBaseInitTypeDef TIM_TimeBaseStructure;
NVIC_InitTypeDef NVIC_InitStructure;
NVIC_InitStructure.NVIC_IRQChannel = TIM2_IRQn;
NVIC_InitStructure.NVIC_IRQChannelPreemptionPriority = 0;
NVIC_InitStructure.NVIC_IRQChannelSubPriority = 1;
NVIC_InitStructure.NVIC_IRQChannelCmd = ENABLE;
NVIC_Init(&NVIC_InitStructure);
RCC_APB1PeriphClockCmd(RCC_APB1Periph_TIM2, ENABLE);
TIM_TimeBaseStructure.TIM_Period = 20;
TIM_TimeBaseStructure.TIM_Prescaler = 24 - 1;
TIM_TimeBaseStructure.TIM_ClockDivision = 0;
TIM_TimeBaseStructure.TIM_CounterMode = TIM_CounterMode_Up;
TIM_TimeBaseInit(TIM2, &TIM_TimeBaseStructure);
TIM_ITConfig(TIM2, TIM_IT_Update, ENABLE);
TIM_Cmd(TIM2, ENABLE);
/****************************GPIO_Init******************************/
void GPIO_setup()
{
GPIO_InitTypeDef GPIO_InitStructure;
/**********************Config Uart**************************/
RCC_APB2PeriphClockCmd(RCC_APB2Periph_GPIOA|RCC_APB2Periph_AFIO,ENABLE);
GPIO_InitStructure.GPIO_Pin = GPIO_Pin_9;
GPIO_InitStructure.GPIO_Speed = GPIO_Speed_50MHz;
GPIO_InitStructure.GPIO_Mode = GPIO_Mode_AF_PP;
GPIO_Init(GPIOA, &GPIO_InitStructure);
GPIO_InitStructure.GPIO_Pin = GPIO_Pin_10;
GPIO_InitStructure.GPIO_Mode = GPIO_Mode_IN_FLOATING;
GPIO_Init(GPIOA, &GPIO_InitStructure);
/****************Enable the Button Clock********************/
RCC_APB2PeriphClockCmd(RCC_APB2Periph_GPIOB,ENABLE);
RCC_APB2PeriphClockCmd(RCC_APB2Periph_GPIOC,ENABLE);
/****************Configure Switch pin as input float******************/
GPIO_InitStructure.GPIO_Mode = GPIO_Mode_IN_FLOATING;
GPIO_InitStructure.GPIO_Pin = GPIO_Pin_3|GPIO_Pin_4|GPIO_Pin_5|GPIO_Pin_7;
GPIO_Init(GPIOA, &GPIO_InitStructure);
GPIO_InitStructure.GPIO_Mode = GPIO_Mode_IN_FLOATING;
GPIO_InitStructure.GPIO_Pin = GPIO_Pin_4|GPIO_Pin_5;
GPIO_Init(GPIOC, &GPIO_InitStructure);
/****************Configure Drive Mosfet output push-pull******************/
GPIO_InitStructure.GPIO_Mode = GPIO_Mode_Out_PP;
GPIO_InitStructure.GPIO_Pin =
GPIO_Pin_0|GPIO_Pin_1|GPIO_Pin_2|GPIO_Pin_5|GPIO_Pin_6|GPIO_Pin_7;
GPIO_InitStructure.GPIO_Speed = GPIO_Speed_10MHz;
GPIO_Init(GPIOB, &GPIO_InitStructure);
/**************************Set Output PWM***************************/
GPIO_InitStructure.GPIO_Pin = GPIO_Pin_6;
GPIO_InitStructure.GPIO_Mode = GPIO_Mode_AF_PP;
GPIO_InitStructure.GPIO_Speed = GPIO_Speed_50MHz;
GPIO_Init(GPIOA, &GPIO_InitStructure);
/*******************************Test Output******************************/
GPIO_InitStructure.GPIO_Mode = GPIO_Mode_Out_PP;
GPIO_InitStructure.GPIO_Pin = GPIO_Pin_9;
GPIO_InitStructure.GPIO_Speed = GPIO_Speed_10MHz;
GPIO_Init(GPIOC, &GPIO_InitStructure);
}}
/*************************Set RCC PWM***************************/
void RCC_Configuration(void)
{
RCC_APB1PeriphClockCmd(RCC_APB1Periph_TIM3, ENABLE);
RCC_APB2PeriphClockCmd(RCC_APB2Periph_GPIOA|RCC_APB2Periph_AFIO,ENABLE);
}
/****************************EXIT_Init******************************/
void EXTI_setup()
{
EXTI_InitTypeDef EXTI_InitStructure;
RCC_APB2PeriphClockCmd(RCC_APB2Periph_AFIO, ENABLE);
GPIO_EXTILineConfig(GPIO_PortSourceGPIOA, GPIO_PinSource0);
EXTI_InitStructure.EXTI_Line = EXTI_Line0;
EXTI_InitStructure.EXTI_Mode = EXTI_Mode_Interrupt;
EXTI_InitStructure.EXTI_Trigger = EXTI_Trigger_Rising;
EXTI_InitStructure.EXTI_LineCmd = ENABLE;
GPIO_EXTILineConfig(GPIO_PortSourceGPIOB, GPIO_PinSource0);
EXTI_InitStructure.EXTI_Line = EXTI_Line1;
EXTI_InitStructure.EXTI_Mode = EXTI_Mode_Interrupt;
EXTI_InitStructure.EXTI_Trigger = EXTI_Trigger_Rising;
EXTI_InitStructure.EXTI_LineCmd = ENABLE;
GPIO_EXTILineConfig(GPIO_PortSourceGPIOC, GPIO_PinSource0);
EXTI_InitStructure.EXTI_Line = EXTI_Line2;
EXTI_InitStructure.EXTI_Mode = EXTI_Mode_Interrupt;
EXTI_InitStructure.EXTI_Trigger = EXTI_Trigger_Rising;
EXTI_InitStructure.EXTI_LineCmd = ENABLE;11
EXTI_Init(&EXTI_InitStructure);
}
/******************************NVIC_setup******************************/
void NVIC_setup()
{
NVIC_InitTypeDef NVIC_InitStructure;
NVIC_InitStructure.NVIC_IRQChannel = EXTI0_IRQn;
NVIC_InitStructure.NVIC_IRQChannelPreemptionPriority = 0x0F;
NVIC_InitStructure.NVIC_IRQChannelSubPriority = 0x0F;
NVIC_InitStructure.NVIC_IRQChannelCmd = ENABLE;
NVIC_Init(&NVIC_InitStructure);
}
/******************************EXTI0_IRQ******************************/
void EXTI0_IRQHander()
{
if(EXTI_GetITStatus(EXTI_Line0) !=RESET)
{
GPIO_WriteBit(GPIOB,GPIO_Pin_3,(1-GPIO_ReadOutputDataBit(GPIOB,GPIO_Pin_3)));
}
EXTI_ClearITPendingBit(EXTI_Line0);
if(EXTI_GetITStatus(EXTI_Line1) !=RESET)
{
GPIO_WriteBit(GPIOB,GPIO_Pin_4,(1-GPIO_ReadOutputDataBit(GPIOB,GPIO_Pin_4)));
}
EXTI_ClearITPendingBit(EXTI_Line1);
if(EXTI_GetITStatus(EXTI_Line2) !=RESET)
{
GPIO_WriteBit(GPIOB,GPIO_Pin_5,(1-GPIO_ReadOutputDataBit(GPIOB,GPIO_Pin_5)));
}
EXTI_ClearITPendingBit(EXTI_Line2);
}
/**************************Uart******************************/
void USART1_setup()
{
USART_InitTypeDef USART_InitStructure;
RCC_APB2PeriphClockCmd(RCC_APB2Periph_USART1,ENABLE);
USART_InitStructure.USART_BaudRate = 115200;
USART_InitStructure.USART_WordLength = USART_WordLength_8b;
USART_InitStructure.USART_StopBits = USART_StopBits_1;
USART_InitStructure.USART_HardwareFlowControl = USART_HardwareFlowControl_None;
USART_InitStructure.USART_Mode = USART_Mode_Rx | USART_Mode_Tx;
USART_Init(USART1, &USART_InitStructure);
USART_Cmd(USART1, ENABLE);
}
/***********************GPIO_ADC****************************/
void GPIO_ADC_setup()
{
GPIO_InitTypeDef GPIO_InitStructure;
RCC_ADCCLKConfig(RCC_PCLK2_Div2);
RCC_AHBPeriphClockCmd(RCC_AHBPeriph_DMA1, ENABLE);
RCC_APB1PeriphClockCmd(RCC_APB1Periph_DAC | RCC_APB1Periph_TIM2 |
RCC_APB1Periph_TIM3, ENABLE);
RCC_APB2PeriphClockCmd(RCC_APB2Periph_ADC1 | RCC_APB2Periph_AFIO |
RCC_APB2Periph_GPIOA, ENABLE);
/********************* Configure PORTA GPIO ***************************/
/* ADC Inputs for Port A. */
GPIO_InitStructure.GPIO_Speed = GPIO_Speed_2MHz;
GPIO_InitStructure.GPIO_Pin = GPIO_Pin_1 | GPIO_Pin_2;
GPIO_InitStructure.GPIO_Mode = GPIO_Mode_AIN;
GPIO_Init(GPIOA, &GPIO_InitStructure);
}
/************************ADC_Setup****************************/
void ADC_setup()
{
ADC_InitTypeDef ADC_InitStructure;
DMA_InitTypeDef DMA_InitStructure;
DMA_InitStructure.DMA_M2M = DMA_M2M_Disable;
DMA_DeInit(DMA1_Channel1);
DMA_InitStructure.DMA_PeripheralBaseAddr = ADC1_DR_Address;
DMA_InitStructure.DMA_MemoryBaseAddr = (uint32_t)&ADCValues[0];
DMA_InitStructure.DMA_DIR = DMA_DIR_PeripheralSRC;
DMA_InitStructure.DMA_BufferSize = ADC_NUMCHANS;
DMA_InitStructure.DMA_PeripheralInc = DMA_PeripheralInc_Disable;
DMA_InitStructure.DMA_MemoryInc = DMA_MemoryInc_Enable;
DMA_InitStructure.DMA_PeripheralDataSize = DMA_PeripheralDataSize_HalfWord;
DMA_InitStructure.DMA_MemoryDataSize = DMA_MemoryDataSize_HalfWord;
DMA_InitStructure.DMA_Mode = DMA_Mode_Circular;
DMA_InitStructure.DMA_Priority = DMA_Priority_High;
DMA_Init(DMA1_Channel1, &DMA_InitStructure);
DMA_Cmd(DMA1_Channel1, ENABLE);
ADC_InitStructure.ADC_Mode = ADC_Mode_Independent;
ADC_InitStructure.ADC_ScanConvMode = ENABLE;
ADC_InitStructure.ADC_ContinuousConvMode = ENABLE;
ADC_InitStructure.ADC_ExternalTrigConv = ADC_ExternalTrigConv_None;
ADC_InitStructure.ADC_DataAlign = ADC_DataAlign_Right;
ADC_InitStructure.ADC_NbrOfChannel = ADC_NUMCHANS;
ADC_Init(ADC1, &ADC_InitStructure);
ADC_RegularChannelConfig(ADC1, ADC_Channel_1, 1, ADC_SampleTime_13Cycles5);
ADC_RegularChannelConfig(ADC1, ADC_Channel_2, 2, ADC_SampleTime_13Cycles5);
ADC_DMACmd(ADC1, ENABLE);
ADC_Cmd(ADC1, ENABLE);
ADC_ResetCalibration(ADC1);
while(ADC_GetResetCalibrationStatus(ADC1));
ADC_StartCalibration(ADC1);
while(ADC_GetCalibrationStatus(ADC1));
ADC_SoftwareStartConvCmd(ADC1, ENABLE);
}
/******************Function USART1 send 1 character*********************/
void usart1_putc(unsigned char c)
{
while(USART_GetFlagStatus(USART1,USART_FLAG_TXE) == RESET);
USART_SendData (USART1,(int)c);
}
/******************Function USART1 send 1 character*********************/
void usart1_puts(unsigned char *c)
{
while(*c)
{
usart1_putc(*c++);
} }
/******************Function USART1 send 1 character*********************/
int usart1_getc()
{
while(USART_GetFlagStatus(USART1,USART_FLAG_RXNE));
return(USART_ReceiveData(USART1));
}
/**************************Step Drive Blush less************************/
void Drive_Motor_(unsigned int step)
{
switch(step)
{
case 0 : {GPIO_WriteBit(GPIOB,GPIO_Pin_0,Step[0][0]);
GPIO_WriteBit(GPIOB,GPIO_Pin_1,Step[0][2]);
GPIO_WriteBit(GPIOB,GPIO_Pin_2,Step[0][4]);
GPIO_WriteBit(GPIOB,GPIO_Pin_7,Step[0][1]);
GPIO_WriteBit(GPIOB,GPIO_Pin_6,Step[0][3]);
GPIO_WriteBit(GPIOB,GPIO_Pin_5,Step[0][5]);} break;12
case 1 : {GPIO_WriteBit(GPIOB,GPIO_Pin_0,Step[1][0]);
GPIO_WriteBit(GPIOB,GPIO_Pin_1,Step[1][2]);
GPIO_WriteBit(GPIOB,GPIO_Pin_2,Step[1][4]);
GPIO_WriteBit(GPIOB,GPIO_Pin_7,Step[1][1]);
GPIO_WriteBit(GPIOB,GPIO_Pin_6,Step[1][3]);
GPIO_WriteBit(GPIOB,GPIO_Pin_5,Step[1][5]);} break;
case 2 : {GPIO_WriteBit(GPIOB,GPIO_Pin_0,Step[2][0]);
GPIO_WriteBit(GPIOB,GPIO_Pin_1,Step[2][2]);
GPIO_WriteBit(GPIOB,GPIO_Pin_2,Step[2][4]);
GPIO_WriteBit(GPIOB,GPIO_Pin_7,Step[2][1]);
GPIO_WriteBit(GPIOB,GPIO_Pin_6,Step[2][3]);
GPIO_WriteBit(GPIOB,GPIO_Pin_5,Step[2][5]);} break;
case 3 : {GPIO_WriteBit(GPIOB,GPIO_Pin_0,Step[3][0]);
GPIO_WriteBit(GPIOB,GPIO_Pin_1,Step[3][2]);
GPIO_WriteBit(GPIOB,GPIO_Pin_2,Step[3][4]);
GPIO_WriteBit(GPIOB,GPIO_Pin_7,Step[3][1]);
GPIO_WriteBit(GPIOB,GPIO_Pin_6,Step[3][3]);
GPIO_WriteBit(GPIOB,GPIO_Pin_5,Step[3][5]);} break;
case 4 : {GPIO_WriteBit(GPIOB,GPIO_Pin_0,Step[4][0]);
GPIO_WriteBit(GPIOB,GPIO_Pin_1,Step[4][2]);
GPIO_WriteBit(GPIOB,GPIO_Pin_2,Step[4][4]);
GPIO_WriteBit(GPIOB,GPIO_Pin_7,Step[4][1]);GPIO_WriteBit(GPIOB,GPIO_Pin_6,Step[4][3]);
GPIO_WriteBit(GPIOB,GPIO_Pin_5,Step[4][5]);} break;
case 5 : {GPIO_WriteBit(GPIOB,GPIO_Pin_0,Step[5][0]);
GPIO_WriteBit(GPIOB,GPIO_Pin_1,Step[5][2]);
GPIO_WriteBit(GPIOB,GPIO_Pin_2,Step[5][4]);
GPIO_WriteBit(GPIOB,GPIO_Pin_7,Step[5][1]);
GPIO_WriteBit(GPIOB,GPIO_Pin_6,Step[5][3]);
GPIO_WriteBit(GPIOB,GPIO_Pin_5,Step[5][5]);} break;
case 6 : {GPIO_WriteBit(GPIOB,GPIO_Pin_0,Step[6][0]);
GPIO_WriteBit(GPIOB,GPIO_Pin_1,Step[6][2]);
GPIO_WriteBit(GPIOB,GPIO_Pin_2,Step[6][4]);
GPIO_WriteBit(GPIOB,GPIO_Pin_7,Step[6][1]);
GPIO_WriteBit(GPIOB,GPIO_Pin_6,Step[6][3]);
GPIO_WriteBit(GPIOB,GPIO_Pin_5,Step[6][5]);} break;
} }
/*************************Timer Overflow****************************/
void TIM2_IRQHandler(void)
{
if (TIM_GetITStatus(TIM2, TIM_IT_Update) != RESET)
{
TIM_ClearITPendingBit(TIM2, TIM_IT_Update);
if(start==1)
{
if(Count_PWM<10) Count_PWM++; else Count_PWM = 0;
if(Count_PWM<(Duty/10)) GPIO_WriteBit(GPIOC,GPIO_Pin_9,1); else
GPIO_WriteBit(GPIOC,GPIO_Pin_9,0);
Count_speed++;
if(Count_speed>speed)
{
Count_speed = 0;
if(Count<24) Count++; else Count = 0;
if(direct==1)
{
if(Count==4) {step = 1; Drive_Motor_(1);}
else if(Count==8) {step = 2; Drive_Motor_(2);}
else if(Count==12) {step = 3; Drive_Motor_(3);}
else if(Count==16) {step = 4; Drive_Motor_(4);}
else if(Count==20) {step = 5; Drive_Motor_(5);}
else if(Count==24) {step = 6; Drive_Motor_(6);}
}
else if(direct==2)
{
if(Count==4) {step = 6; Drive_Motor_(6);}
else if(Count==8) {step = 5; Drive_Motor_(5);}
else if(Count==12) {step = 4; Drive_Motor_(4);}
else if(Count==16) {step = 3; Drive_Motor_(3);}
else if(Count==20) {step = 2; Drive_Motor_(2);}
else if(Count==24) {step = 1; Drive_Motor_(1);}
}
}
}
else {Drive_Motor_(0); GPIO_WriteBit(GPIOC,GPIO_Pin_9,0);}
}
}
/******************************Check Switch Mode***********************/
void Check_Switch_Mode(void)
{
if(GPIO_ReadInputDataBit(GPIOC,GPIO_Pin_4)==0) {if(Mode<6) Mode++;}
else if(GPIO_ReadInputDataBit(GPIOA,GPIO_Pin_7)==0) {if(Mode>1) Mode--;}
}
/******************************Check Switch Mode***********************/
void Check_Switch_select(void)
{
if(GPIO_ReadInputDataBit(GPIOC,GPIO_Pin_5)==0) select = 1;
else if(GPIO_ReadInputDataBit(GPIOA,GPIO_Pin_5)==0) select = 0;
}
/******************************Check Switch Mode***********************/
void Check_Switch_start(void)
{
if(GPIO_ReadInputDataBit(GPIOA,GPIO_Pin_4)==0) start = 1;
else if(GPIO_ReadInputDataBit(GPIOA,GPIO_Pin_3)==0) start = 0;
}
/******************************Check Switch Mode***********************/
void Check_Switch_start(void)
{
if(GPIO_ReadInputDataBit(GPIOA,GPIO_Pin_4)==0) start = 1;
else if(GPIO_ReadInputDataBit(GPIOA,GPIO_Pin_3)==0) start = 0;
}
/******************************Check Switch Mode***********************/
void Show_LCD_main(void)12
{
goto_cursor(0x00);
sprintf(lcd_buff," Please select ");
lcd_print(lcd_buff);
goto_cursor(0x40);
sprintf(lcd_buff," Lab:%01i ",Mode);
lcd_print(lcd_buff);
}
/******************************Check Switch Mode***********************/
void Show_LCD_Lab_1(void)
{
goto_cursor(0x00);
sprintf(lcd_buff," Test Lab:%01i ",Mode);
lcd_print(lcd_buff);
goto_cursor(0x40);
if(start==1) sprintf(lcd_buff,"Status:RUN ");
else if(start==0) sprintf(lcd_buff,"Status:Stop ");
lcd_print(lcd_buff);
}
/******************************Check Switch Mode***********************/
void Show_LCD_Lab_2(void)
{
goto_cursor(0x00);
sprintf(lcd_buff," Test Lab:%01i ",Mode);
lcd_print(lcd_buff);
goto_cursor(0x40);
if(start==1) sprintf(lcd_buff,"Status:RUN ");
else if(start==0) sprintf(lcd_buff,"Status:Stop ");
lcd_print(lcd_buff);12
}
/***************************Check Switch Mode***********************/
void Show_LCD_Lab_3(void)
{
goto_cursor(0x00);
sprintf(lcd_buff," Test Lab:%01i ",Mode);
lcd_print(lcd_buff);
goto_cursor(0x40);
if(start==1)
{
if(direct==1) sprintf(lcd_buff,"Status:Right ");
else if(direct==2) sprintf(lcd_buff,"Status:Left ");
}
else if(start==0) sprintf(lcd_buff,"Status:Stop ");
lcd_print(lcd_buff);
}
/******************************Check Switch Mode***********************/
void Show_LCD_Lab_4(void)
{
goto_cursor(0x00);
sprintf(lcd_buff," Test Lab:%01i ",Mode);
lcd_print(lcd_buff);
goto_cursor(0x40);
if(start==1) sprintf(lcd_buff,"Status:RUN D:%02i",Duty);
else if(start==0) sprintf(lcd_buff,"Status:Stop ");
lcd_print(lcd_buff);
}
/******************************Check Switch Mode***********************/
void Show_LCD_Lab_5(void)
{
goto_cursor(0x00);
sprintf(lcd_buff," Test Lab:%01i ",Mode);
lcd_print(lcd_buff);
goto_cursor(0x40);
if(start==1) sprintf(lcd_buff,"Accel:%4.1f ",Accel);
else if(start==0) sprintf(lcd_buff,"Status:Stop ");
lcd_print(lcd_buff);
}
/******************************Check Switch Mode***********************/
void Show_LCD_Lab_6(void)
{
goto_cursor(0x00);
sprintf(lcd_buff," Test Lab:%01i ",Mode);
lcd_print(lcd_buff);
goto_cursor(0x40);
if(start==1) sprintf(lcd_buff,"Status:RUN D:%02i",Duty);
else if(start==0) sprintf(lcd_buff,"Status:Stop ");
lcd_print(lcd_buff);
}
/******************************Main function****************************/
int main (void)
{
GPIO_setup();
NVIC_setup();
GPIO_Timer();
GPIO_ADC_setup();
ADC_setup();
lcd_init();
Delay(100);
while(1)
{
Check_Switch_Mode();
Check_Switch_select();
Check_Switch_start();
if(select==0) Show_LCD_main();
else if(select==1)
{
if(Mode==1)
{
direct = 1;
while(select==1)
{
Check_Switch_select();
Check_Switch_start();
Show_LCD_Lab_1();
speed = 4+ADCValues[1]/200; Duty = 100;
Delay(20);
}
start=0;
}
else if(Mode==2)
{
    direct = 1;
while(select==1)
{
Check_Switch_select();
Check_Switch_start();
Show_LCD_Lab_2();
speed = 4+ADCValues[1]/200; Duty = 60-ADCValues[1]/200;
Delay(20);
}
start=0;
}
else if(Mode==3)
{
direct = 1;
while(select==1)
{
Check_Switch_select();
Check_Switch_start();
if(GPIO_ReadInputDataBit(GPIOC,GPIO_Pin_4)==0) {if(direct==2) {start=0;
Delay(500); start=1;} direct=1;}
else if(GPIO_ReadInputDataBit(GPIOA,GPIO_Pin_7)==0) {if(direct==1) {start=0;
Delay(500); start=1;} direct=2;}
Show_LCD_Lab_3();
speed = 4+ADCValues[1]/200; Duty = 60-ADCValues[1]/200;
Delay(20);
}
direct = 1;
start=0;
}
else if(Mode==4)
{
direct = 1;
while(select==1)
{
Check_Switch_select();
Check_Switch_start();
if(GPIO_ReadInputDataBit(GPIOC,GPIO_Pin_4)==0) {if(Duty<99) Duty++;
Delay(100);}
else if(GPIO_ReadInputDataBit(GPIOA,GPIO_Pin_7)==0) {if(Duty>0) Duty--;
Delay(100);}
Show_LCD_Lab_4();
speed = 4+ADCValues[1]/200;
Delay(20);
}
start=0;
}
else if(Mode==5)
{
direct = 1;
while(select==1)
{
Check_Switch_select();
Check_Switch_start();
Accel = ADCValues[0];
Show_LCD_Lab_5();
speed = 4+ADCValues[1]/200;
Duty = 60-ADCValues[1]/200+(Accel-2200)*0.0574;
Delay(20);
}
start=0;
}
else if(Mode==6)
{
direct = 1;
while(select==1)
{
Check_Switch_select();
Check_Switch_start();
if(GPIO_ReadInputDataBit(GPIOC,GPIO_Pin_4)==0) {if(Duty<99) Duty++;
Delay(100);}
else if(GPIO_ReadInputDataBit(GPIOA,GPIO_Pin_7)==0) {if(Duty>0) Duty--;
Delay(100);}
Show_LCD_Lab_6();
speed = 4+ADCValues[1]/200;
Delay(20);
}
start=0;
}
}
Delay(50);
}
}