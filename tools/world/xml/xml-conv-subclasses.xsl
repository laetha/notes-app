<xsl:stylesheet version="1.0" encoding="UTF-8" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output indent="yes"/>
  <xsl:strip-space elements="*"/>

  <!-- IDENTITY TRANSFORM TO COPY DOCUMENT AS IS -->
  <xsl:template match="@*|node()">
    <xsl:copy>
      <xsl:apply-templates select="@*|node()"/>
    </xsl:copy>
  </xsl:template>

  <xsl:template match="subclass">
    <xsl:copy>
      <xsl:apply-templates select="name|hd|saves|source|proficiency|spellAbility|numSkills|class"/>

      <multiclass>
      <xsl:for-each select="multiclass">
          <xsl:value-of select="name" />
          <xsl:text> &#xa;</xsl:text>
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text>&#xa;</xsl:text>

          </xsl:for-each>
          <xsl:text>&#xa;</xsl:text>
      </xsl:for-each>
    </multiclass>

      <xsl:for-each select="lvl01skill">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="lvl01skill{$pos}name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="lvl01skill{$pos}text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="lvl02skill">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="lvl02skill{$pos}name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="lvl02skill{$pos}text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="lvl03skill">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="lvl03skill{$pos}name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="lvl03skill{$pos}text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="lvl04skill">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="lvl04skill{$pos}name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="lvl04skill{$pos}text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="lvl05skill">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="lvl05skill{$pos}name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="lvl05skill{$pos}text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="lvl06skill">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="lvl06skill{$pos}name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="lvl06skill{$pos}text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="lvl07skill">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="lvl07skill{$pos}name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="lvl07skill{$pos}text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="lvl08skill">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="lvl08skill{$pos}name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="lvl08skill{$pos}text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="lvl09skill">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="lvl09skill{$pos}name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="lvl09skill{$pos}text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="lvl10skill">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="lvl10skill{$pos}name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="lvl10skill{$pos}text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="lvl11skill">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="lvl11skill{$pos}name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="lvl11skill{$pos}text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="lvl12skill">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="lvl12skill{$pos}name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="lvl12skill{$pos}text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="lvl13skill">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="lvl13skill{$pos}name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="lvl13skill{$pos}text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="lvl14skill">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="lvl14skill{$pos}name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="lvl14skill{$pos}text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="lvl15skill">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="lvl15skill{$pos}name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="lvl15skill{$pos}text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="lvl16skill">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="lvl16skill{$pos}name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="lvl16skill{$pos}text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="lvl17skill">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="lvl17skill{$pos}name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="lvl17skill{$pos}text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="lvl18skill">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="lvl18skill{$pos}name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="lvl18skill{$pos}text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="lvl19skill">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="lvl19skill{$pos}name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="lvl19skill{$pos}text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="lvl20skill">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="lvl20skill{$pos}name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="lvl20skill{$pos}text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text>&#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>


    </xsl:copy>
  </xsl:template>

</xsl:stylesheet>
