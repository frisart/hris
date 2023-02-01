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

 Date: 30/12/2022 09:18:10
*/


-- ----------------------------
-- Table structure for fileGLd_jurnal_temp
-- ----------------------------
IF EXISTS (SELECT * FROM sys.all_objects WHERE object_id = OBJECT_ID(N'[dbo].[fileGLd_jurnal_temp]') AND type IN ('U'))
	DROP TABLE [dbo].[fileGLd_jurnal_temp]
GO

CREATE TABLE [dbo].[fileGLd_jurnal_temp] (
  [ledger_no] nvarchar(30) COLLATE SQL_Latin1_General_CP1_CI_AS  NULL,
  [idx_pointer] nvarchar(4) COLLATE SQL_Latin1_General_CP1_CI_AS  NULL,
  [gl_account] nvarchar(11) COLLATE SQL_Latin1_General_CP1_CI_AS  NULL,
  [descript] varchar(max) COLLATE SQL_Latin1_General_CP1_CI_AS  NULL,
  [debit] money  NULL,
  [credit] money  NULL,
  [debit_aj] money  NULL,
  [credit_aj] money  NULL,
  [job_no] nvarchar(15) COLLATE SQL_Latin1_General_CP1_CI_AS  NULL,
  [gl_date] smalldatetime  NULL,
  [fiscal_1] nvarchar(6) COLLATE SQL_Latin1_General_CP1_CI_AS  NULL,
  [fiscal_2] nvarchar(6) COLLATE SQL_Latin1_General_CP1_CI_AS  NULL,
  [store] nvarchar(4) COLLATE SQL_Latin1_General_CP1_CI_AS  NULL
)
GO

ALTER TABLE [dbo].[fileGLd_jurnal_temp] SET (LOCK_ESCALATION = TABLE)
GO


-- ----------------------------
-- Indexes structure for table fileGLd_jurnal_temp
-- ----------------------------
CREATE NONCLUSTERED INDEX [IX_fileGLd_jurnal_temp]
ON [dbo].[fileGLd_jurnal_temp] (
  [gl_account] ASC,
  [gl_date] ASC,
  [store] ASC
)
GO

CREATE NONCLUSTERED INDEX [IX_fileGLd_jurnal_temp_1]
ON [dbo].[fileGLd_jurnal_temp] (
  [ledger_no] ASC
)
GO

CREATE NONCLUSTERED INDEX [IX_fileGLd_jurnal_temp_2]
ON [dbo].[fileGLd_jurnal_temp] (
  [ledger_no] ASC,
  [idx_pointer] ASC
)
GO

CREATE NONCLUSTERED INDEX [IX_fileGLd_jurnal_temp_3]
ON [dbo].[fileGLd_jurnal_temp] (
  [gl_account] ASC,
  [store] ASC,
  [fiscal_1] ASC
)
GO

CREATE NONCLUSTERED INDEX [IX_fileGLd_jurnal_temp_4]
ON [dbo].[fileGLd_jurnal_temp] (
  [gl_account] ASC,
  [fiscal_1] ASC
)
GO

CREATE NONCLUSTERED INDEX [IX_fileGLd_jurnal_temp_5]
ON [dbo].[fileGLd_jurnal_temp] (
  [store] ASC,
  [ledger_no] ASC,
  [fiscal_1] ASC
)
GO

CREATE NONCLUSTERED INDEX [IX_fileGLd_jurnal_temp_6]
ON [dbo].[fileGLd_jurnal_temp] (
  [store] ASC,
  [fiscal_1] ASC,
  [ledger_no] ASC
)
GO

