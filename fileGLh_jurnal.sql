/*
 Navicat Premium Data Transfer

 Source Server         : SQLSERVER2008
 Source Server Type    : SQL Server
 Source Server Version : 10504042
 Source Host           : GERY\MSSQLSERVER2:1433
 Source Catalog        : RAS_GL_DB
 Source Schema         : dbo

 Target Server Type    : SQL Server
 Target Server Version : 10504042
 File Encoding         : 65001

 Date: 30/12/2022 09:13:43
*/


-- ----------------------------
-- Table structure for fileGLh_jurnal_temp
-- ----------------------------
IF EXISTS (SELECT * FROM sys.all_objects WHERE object_id = OBJECT_ID(N'[dbo].[fileGLh_jurnal_temp]') AND type IN ('U'))
	DROP TABLE [dbo].[fileGLh_jurnal_temp]
GO

CREATE TABLE [dbo].[fileGLh_jurnal_temp] (
  [ledger_no] nvarchar(30) COLLATE SQL_Latin1_General_CP1_CI_AS  NULL,
  [batch_no] nvarchar(30) COLLATE SQL_Latin1_General_CP1_CI_AS  NULL,
  [batch_ctrl] money  NULL,
  [fiscal] nvarchar(4) COLLATE SQL_Latin1_General_CP1_CI_AS  NULL,
  [gl_date] smalldatetime  NULL,
  [descript] nvarchar(max) COLLATE SQL_Latin1_General_CP1_CI_AS  NULL,
  [source] nvarchar(2) COLLATE SQL_Latin1_General_CP1_CI_AS  NULL,
  [userid] nvarchar(15) COLLATE SQL_Latin1_General_CP1_CI_AS  NULL,
  [status] nvarchar(2) COLLATE SQL_Latin1_General_CP1_CI_AS  NULL,
  [gl_type] nvarchar(1) COLLATE SQL_Latin1_General_CP1_CI_AS  NULL,
  [store] nvarchar(4) COLLATE SQL_Latin1_General_CP1_CI_AS  NULL
)
GO

ALTER TABLE [dbo].[fileGLh_jurnal_temp] SET (LOCK_ESCALATION = TABLE)
GO

