<?php

/*
 * Generated from Golampi.g4 by ANTLR 4.13.2
 */

namespace generated;
use Antlr\Antlr4\Runtime\Tree\ParseTreeListener;

/**
 * This interface defines a complete listener for a parse tree produced by
 * {@see GolampiParser}.
 */
interface GolampiListener extends ParseTreeListener {
	/**
	 * Enter a parse tree produced by {@see GolampiParser::program()}.
	 * @param $context The parse tree.
	 */
	public function enterProgram(Context\ProgramContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::program()}.
	 * @param $context The parse tree.
	 */
	public function exitProgram(Context\ProgramContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::functionDecl()}.
	 * @param $context The parse tree.
	 */
	public function enterFunctionDecl(Context\FunctionDeclContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::functionDecl()}.
	 * @param $context The parse tree.
	 */
	public function exitFunctionDecl(Context\FunctionDeclContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::params()}.
	 * @param $context The parse tree.
	 */
	public function enterParams(Context\ParamsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::params()}.
	 * @param $context The parse tree.
	 */
	public function exitParams(Context\ParamsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::param()}.
	 * @param $context The parse tree.
	 */
	public function enterParam(Context\ParamContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::param()}.
	 * @param $context The parse tree.
	 */
	public function exitParam(Context\ParamContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::returnTypes()}.
	 * @param $context The parse tree.
	 */
	public function enterReturnTypes(Context\ReturnTypesContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::returnTypes()}.
	 * @param $context The parse tree.
	 */
	public function exitReturnTypes(Context\ReturnTypesContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::block()}.
	 * @param $context The parse tree.
	 */
	public function enterBlock(Context\BlockContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::block()}.
	 * @param $context The parse tree.
	 */
	public function exitBlock(Context\BlockContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function enterStatement(Context\StatementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function exitStatement(Context\StatementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::statementCore()}.
	 * @param $context The parse tree.
	 */
	public function enterStatementCore(Context\StatementCoreContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::statementCore()}.
	 * @param $context The parse tree.
	 */
	public function exitStatementCore(Context\StatementCoreContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::printStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterPrintStmt(Context\PrintStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::printStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitPrintStmt(Context\PrintStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::varDecl()}.
	 * @param $context The parse tree.
	 */
	public function enterVarDecl(Context\VarDeclContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::varDecl()}.
	 * @param $context The parse tree.
	 */
	public function exitVarDecl(Context\VarDeclContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::constDecl()}.
	 * @param $context The parse tree.
	 */
	public function enterConstDecl(Context\ConstDeclContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::constDecl()}.
	 * @param $context The parse tree.
	 */
	public function exitConstDecl(Context\ConstDeclContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::shortVarDecl()}.
	 * @param $context The parse tree.
	 */
	public function enterShortVarDecl(Context\ShortVarDeclContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::shortVarDecl()}.
	 * @param $context The parse tree.
	 */
	public function exitShortVarDecl(Context\ShortVarDeclContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::assignment()}.
	 * @param $context The parse tree.
	 */
	public function enterAssignment(Context\AssignmentContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::assignment()}.
	 * @param $context The parse tree.
	 */
	public function exitAssignment(Context\AssignmentContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::assignTarget()}.
	 * @param $context The parse tree.
	 */
	public function enterAssignTarget(Context\AssignTargetContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::assignTarget()}.
	 * @param $context The parse tree.
	 */
	public function exitAssignTarget(Context\AssignTargetContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::assignOp()}.
	 * @param $context The parse tree.
	 */
	public function enterAssignOp(Context\AssignOpContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::assignOp()}.
	 * @param $context The parse tree.
	 */
	public function exitAssignOp(Context\AssignOpContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::idList()}.
	 * @param $context The parse tree.
	 */
	public function enterIdList(Context\IdListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::idList()}.
	 * @param $context The parse tree.
	 */
	public function exitIdList(Context\IdListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::expList()}.
	 * @param $context The parse tree.
	 */
	public function enterExpList(Context\ExpListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::expList()}.
	 * @param $context The parse tree.
	 */
	public function exitExpList(Context\ExpListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::type()}.
	 * @param $context The parse tree.
	 */
	public function enterType(Context\TypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::type()}.
	 * @param $context The parse tree.
	 */
	public function exitType(Context\TypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::baseType()}.
	 * @param $context The parse tree.
	 */
	public function enterBaseType(Context\BaseTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::baseType()}.
	 * @param $context The parse tree.
	 */
	public function exitBaseType(Context\BaseTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::pointerType()}.
	 * @param $context The parse tree.
	 */
	public function enterPointerType(Context\PointerTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::pointerType()}.
	 * @param $context The parse tree.
	 */
	public function exitPointerType(Context\PointerTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::arrayType()}.
	 * @param $context The parse tree.
	 */
	public function enterArrayType(Context\ArrayTypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::arrayType()}.
	 * @param $context The parse tree.
	 */
	public function exitArrayType(Context\ArrayTypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::arrayDimension()}.
	 * @param $context The parse tree.
	 */
	public function enterArrayDimension(Context\ArrayDimensionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::arrayDimension()}.
	 * @param $context The parse tree.
	 */
	public function exitArrayDimension(Context\ArrayDimensionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::arrayLiteral()}.
	 * @param $context The parse tree.
	 */
	public function enterArrayLiteral(Context\ArrayLiteralContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::arrayLiteral()}.
	 * @param $context The parse tree.
	 */
	public function exitArrayLiteral(Context\ArrayLiteralContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::arrayElements()}.
	 * @param $context The parse tree.
	 */
	public function enterArrayElements(Context\ArrayElementsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::arrayElements()}.
	 * @param $context The parse tree.
	 */
	public function exitArrayElements(Context\ArrayElementsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::arrayElement()}.
	 * @param $context The parse tree.
	 */
	public function enterArrayElement(Context\ArrayElementContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::arrayElement()}.
	 * @param $context The parse tree.
	 */
	public function exitArrayElement(Context\ArrayElementContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::arrayAccess()}.
	 * @param $context The parse tree.
	 */
	public function enterArrayAccess(Context\ArrayAccessContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::arrayAccess()}.
	 * @param $context The parse tree.
	 */
	public function exitArrayAccess(Context\ArrayAccessContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::arrayIndex()}.
	 * @param $context The parse tree.
	 */
	public function enterArrayIndex(Context\ArrayIndexContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::arrayIndex()}.
	 * @param $context The parse tree.
	 */
	public function exitArrayIndex(Context\ArrayIndexContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::pointerAccess()}.
	 * @param $context The parse tree.
	 */
	public function enterPointerAccess(Context\PointerAccessContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::pointerAccess()}.
	 * @param $context The parse tree.
	 */
	public function exitPointerAccess(Context\PointerAccessContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::functionCall()}.
	 * @param $context The parse tree.
	 */
	public function enterFunctionCall(Context\FunctionCallContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::functionCall()}.
	 * @param $context The parse tree.
	 */
	public function exitFunctionCall(Context\FunctionCallContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::functionName()}.
	 * @param $context The parse tree.
	 */
	public function enterFunctionName(Context\FunctionNameContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::functionName()}.
	 * @param $context The parse tree.
	 */
	public function exitFunctionName(Context\FunctionNameContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::args()}.
	 * @param $context The parse tree.
	 */
	public function enterArgs(Context\ArgsContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::args()}.
	 * @param $context The parse tree.
	 */
	public function exitArgs(Context\ArgsContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function enterExpression(Context\ExpressionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function exitExpression(Context\ExpressionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::logicalOrExp()}.
	 * @param $context The parse tree.
	 */
	public function enterLogicalOrExp(Context\LogicalOrExpContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::logicalOrExp()}.
	 * @param $context The parse tree.
	 */
	public function exitLogicalOrExp(Context\LogicalOrExpContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::logicalAndExp()}.
	 * @param $context The parse tree.
	 */
	public function enterLogicalAndExp(Context\LogicalAndExpContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::logicalAndExp()}.
	 * @param $context The parse tree.
	 */
	public function exitLogicalAndExp(Context\LogicalAndExpContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::equalityExp()}.
	 * @param $context The parse tree.
	 */
	public function enterEqualityExp(Context\EqualityExpContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::equalityExp()}.
	 * @param $context The parse tree.
	 */
	public function exitEqualityExp(Context\EqualityExpContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::relationalExp()}.
	 * @param $context The parse tree.
	 */
	public function enterRelationalExp(Context\RelationalExpContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::relationalExp()}.
	 * @param $context The parse tree.
	 */
	public function exitRelationalExp(Context\RelationalExpContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::additiveExp()}.
	 * @param $context The parse tree.
	 */
	public function enterAdditiveExp(Context\AdditiveExpContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::additiveExp()}.
	 * @param $context The parse tree.
	 */
	public function exitAdditiveExp(Context\AdditiveExpContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::multiplicativeExp()}.
	 * @param $context The parse tree.
	 */
	public function enterMultiplicativeExp(Context\MultiplicativeExpContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::multiplicativeExp()}.
	 * @param $context The parse tree.
	 */
	public function exitMultiplicativeExp(Context\MultiplicativeExpContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::unaryExp()}.
	 * @param $context The parse tree.
	 */
	public function enterUnaryExp(Context\UnaryExpContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::unaryExp()}.
	 * @param $context The parse tree.
	 */
	public function exitUnaryExp(Context\UnaryExpContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::primary()}.
	 * @param $context The parse tree.
	 */
	public function enterPrimary(Context\PrimaryContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::primary()}.
	 * @param $context The parse tree.
	 */
	public function exitPrimary(Context\PrimaryContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::ifStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterIfStmt(Context\IfStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::ifStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitIfStmt(Context\IfStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::switchStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterSwitchStmt(Context\SwitchStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::switchStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitSwitchStmt(Context\SwitchStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::caseClause()}.
	 * @param $context The parse tree.
	 */
	public function enterCaseClause(Context\CaseClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::caseClause()}.
	 * @param $context The parse tree.
	 */
	public function exitCaseClause(Context\CaseClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::defaultClause()}.
	 * @param $context The parse tree.
	 */
	public function enterDefaultClause(Context\DefaultClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::defaultClause()}.
	 * @param $context The parse tree.
	 */
	public function exitDefaultClause(Context\DefaultClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::forStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterForStmt(Context\ForStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::forStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitForStmt(Context\ForStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::forClause()}.
	 * @param $context The parse tree.
	 */
	public function enterForClause(Context\ForClauseContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::forClause()}.
	 * @param $context The parse tree.
	 */
	public function exitForClause(Context\ForClauseContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::simpleStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterSimpleStmt(Context\SimpleStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::simpleStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitSimpleStmt(Context\SimpleStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::incDecStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterIncDecStmt(Context\IncDecStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::incDecStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitIncDecStmt(Context\IncDecStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::shortVarDeclNoSemi()}.
	 * @param $context The parse tree.
	 */
	public function enterShortVarDeclNoSemi(Context\ShortVarDeclNoSemiContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::shortVarDeclNoSemi()}.
	 * @param $context The parse tree.
	 */
	public function exitShortVarDeclNoSemi(Context\ShortVarDeclNoSemiContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::assignmentNoSemi()}.
	 * @param $context The parse tree.
	 */
	public function enterAssignmentNoSemi(Context\AssignmentNoSemiContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::assignmentNoSemi()}.
	 * @param $context The parse tree.
	 */
	public function exitAssignmentNoSemi(Context\AssignmentNoSemiContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::breakStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterBreakStmt(Context\BreakStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::breakStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitBreakStmt(Context\BreakStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::continueStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterContinueStmt(Context\ContinueStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::continueStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitContinueStmt(Context\ContinueStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::returnStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterReturnStmt(Context\ReturnStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::returnStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitReturnStmt(Context\ReturnStmtContext $context): void;
}