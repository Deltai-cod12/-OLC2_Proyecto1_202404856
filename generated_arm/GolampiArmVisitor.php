<?php

/*
 * Generated from GolampiArm.g4 by ANTLR 4.13.2
 */

namespace generated_arm;

use Antlr\Antlr4\Runtime\Tree\ParseTreeVisitor;

/**
 * This interface defines a complete generic visitor for a parse tree produced by {@see GolampiArmParser}.
 */
interface GolampiArmVisitor extends ParseTreeVisitor
{
	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::program()}.
	 *
	 * @param Context\ProgramContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitProgram(Context\ProgramContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::functionDecl()}.
	 *
	 * @param Context\FunctionDeclContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitFunctionDecl(Context\FunctionDeclContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::params()}.
	 *
	 * @param Context\ParamsContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitParams(Context\ParamsContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::param()}.
	 *
	 * @param Context\ParamContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitParam(Context\ParamContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::returnTypes()}.
	 *
	 * @param Context\ReturnTypesContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitReturnTypes(Context\ReturnTypesContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::block()}.
	 *
	 * @param Context\BlockContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitBlock(Context\BlockContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::statement()}.
	 *
	 * @param Context\StatementContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStatement(Context\StatementContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::statementCore()}.
	 *
	 * @param Context\StatementCoreContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStatementCore(Context\StatementCoreContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::varDecl()}.
	 *
	 * @param Context\VarDeclContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitVarDecl(Context\VarDeclContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::constDecl()}.
	 *
	 * @param Context\ConstDeclContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitConstDecl(Context\ConstDeclContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::shortVarDecl()}.
	 *
	 * @param Context\ShortVarDeclContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitShortVarDecl(Context\ShortVarDeclContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::assignment()}.
	 *
	 * @param Context\AssignmentContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitAssignment(Context\AssignmentContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::assignTarget()}.
	 *
	 * @param Context\AssignTargetContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitAssignTarget(Context\AssignTargetContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::assignOp()}.
	 *
	 * @param Context\AssignOpContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitAssignOp(Context\AssignOpContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::idList()}.
	 *
	 * @param Context\IdListContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitIdList(Context\IdListContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::expList()}.
	 *
	 * @param Context\ExpListContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpList(Context\ExpListContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::type()}.
	 *
	 * @param Context\TypeContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitType(Context\TypeContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::baseType()}.
	 *
	 * @param Context\BaseTypeContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitBaseType(Context\BaseTypeContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::pointerType()}.
	 *
	 * @param Context\PointerTypeContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitPointerType(Context\PointerTypeContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::arrayType()}.
	 *
	 * @param Context\ArrayTypeContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitArrayType(Context\ArrayTypeContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::arrayDimension()}.
	 *
	 * @param Context\ArrayDimensionContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitArrayDimension(Context\ArrayDimensionContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::arrayLiteral()}.
	 *
	 * @param Context\ArrayLiteralContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitArrayLiteral(Context\ArrayLiteralContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::arrayElements()}.
	 *
	 * @param Context\ArrayElementsContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitArrayElements(Context\ArrayElementsContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::arrayElement()}.
	 *
	 * @param Context\ArrayElementContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitArrayElement(Context\ArrayElementContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::arrayAccess()}.
	 *
	 * @param Context\ArrayAccessContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitArrayAccess(Context\ArrayAccessContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::arrayIndex()}.
	 *
	 * @param Context\ArrayIndexContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitArrayIndex(Context\ArrayIndexContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::pointerAccess()}.
	 *
	 * @param Context\PointerAccessContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitPointerAccess(Context\PointerAccessContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::functionCall()}.
	 *
	 * @param Context\FunctionCallContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitFunctionCall(Context\FunctionCallContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::functionName()}.
	 *
	 * @param Context\FunctionNameContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitFunctionName(Context\FunctionNameContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::args()}.
	 *
	 * @param Context\ArgsContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitArgs(Context\ArgsContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::expression()}.
	 *
	 * @param Context\ExpressionContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpression(Context\ExpressionContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::logicalOrExp()}.
	 *
	 * @param Context\LogicalOrExpContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitLogicalOrExp(Context\LogicalOrExpContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::logicalAndExp()}.
	 *
	 * @param Context\LogicalAndExpContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitLogicalAndExp(Context\LogicalAndExpContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::equalityExp()}.
	 *
	 * @param Context\EqualityExpContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitEqualityExp(Context\EqualityExpContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::relationalExp()}.
	 *
	 * @param Context\RelationalExpContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitRelationalExp(Context\RelationalExpContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::additiveExp()}.
	 *
	 * @param Context\AdditiveExpContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitAdditiveExp(Context\AdditiveExpContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::multiplicativeExp()}.
	 *
	 * @param Context\MultiplicativeExpContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitMultiplicativeExp(Context\MultiplicativeExpContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::unaryExp()}.
	 *
	 * @param Context\UnaryExpContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitUnaryExp(Context\UnaryExpContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::primary()}.
	 *
	 * @param Context\PrimaryContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitPrimary(Context\PrimaryContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::ifStmt()}.
	 *
	 * @param Context\IfStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitIfStmt(Context\IfStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::switchStmt()}.
	 *
	 * @param Context\SwitchStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitSwitchStmt(Context\SwitchStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::caseClause()}.
	 *
	 * @param Context\CaseClauseContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitCaseClause(Context\CaseClauseContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::defaultClause()}.
	 *
	 * @param Context\DefaultClauseContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitDefaultClause(Context\DefaultClauseContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::forStmt()}.
	 *
	 * @param Context\ForStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitForStmt(Context\ForStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::forClause()}.
	 *
	 * @param Context\ForClauseContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitForClause(Context\ForClauseContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::simpleStmt()}.
	 *
	 * @param Context\SimpleStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitSimpleStmt(Context\SimpleStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::incDecStmt()}.
	 *
	 * @param Context\IncDecStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitIncDecStmt(Context\IncDecStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::shortVarDeclNoSemi()}.
	 *
	 * @param Context\ShortVarDeclNoSemiContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitShortVarDeclNoSemi(Context\ShortVarDeclNoSemiContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::assignmentNoSemi()}.
	 *
	 * @param Context\AssignmentNoSemiContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitAssignmentNoSemi(Context\AssignmentNoSemiContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::breakStmt()}.
	 *
	 * @param Context\BreakStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitBreakStmt(Context\BreakStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::continueStmt()}.
	 *
	 * @param Context\ContinueStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitContinueStmt(Context\ContinueStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiArmParser::returnStmt()}.
	 *
	 * @param Context\ReturnStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitReturnStmt(Context\ReturnStmtContext $context);
}